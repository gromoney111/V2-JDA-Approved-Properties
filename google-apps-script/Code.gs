/**
 * V2 JDA Approved Properties — Google Sheets Lead Receiver
 * ----------------------------------------------------------
 * This Google Apps Script receives form submissions from the
 * WordPress site and appends them to a Google Sheet.
 *
 * SETUP (one-time):
 *  1. Open https://sheets.google.com and create a new spreadsheet
 *     called "V2 JDA - Leads".
 *  2. In that spreadsheet, click Extensions → Apps Script.
 *  3. Replace the default code with this entire file. Save.
 *  4. Click "Deploy" → "New deployment" → choose type "Web app".
 *       - Description: V2 JDA Lead Receiver
 *       - Execute as: Me
 *       - Who has access: Anyone
 *     Click Deploy and authorise.
 *  5. Copy the resulting "Web app URL".
 *  6. In WordPress, go to Appearance → Customize → "V2 JDA - Lead Capture"
 *     and paste the URL into "Google Apps Script Web App URL". Publish.
 *
 * That's it. New leads will start arriving in the sheet automatically.
 */

// Optional — if you want to be sure the script writes to a specific
// spreadsheet (rather than the one this script is bound to), paste its ID here.
// You can find the ID in the sheet URL: docs.google.com/spreadsheets/d/<THIS_PART>/edit
var SPREADSHEET_ID = '';

// Sheet/tab name to write to. Will be created if it does not exist.
var SHEET_NAME = 'Leads';

// Optional — comma-separated list of e-mails that should be notified
// in addition to WordPress (leave blank to skip).
var NOTIFY_EMAILS = 'vishalkhandelwal267@gmail.com';

function doPost(e) {
  try {
    var params = (e && e.parameter) ? e.parameter : {};
    var sheet  = getSheet_();

    // Ensure header row exists.
    if (sheet.getLastRow() === 0) {
      sheet.appendRow([
        'Submitted At', 'Name', 'Phone', 'Email', 'Interest',
        'Message', 'Source URL'
      ]);
      sheet.getRange(1, 1, 1, 7)
           .setFontWeight('bold')
           .setBackground('#0e1726')
           .setFontColor('#c9a227');
      sheet.setFrozenRows(1);
    }

    var row = [
      params.submitted_at || new Date(),
      params.name      || '',
      params.phone     || '',
      params.email     || '',
      params.interest  || '',
      params.message   || '',
      params.source    || ''
    ];
    sheet.appendRow(row);

    // Optional email notification.
    if (NOTIFY_EMAILS) {
      var subj = '[V2 JDA] New Lead: ' + (params.name || 'Unknown');
      var body = 'A new enquiry was received on the website.\n\n' +
                 'Name: '     + (params.name      || '') + '\n' +
                 'Phone: '    + (params.phone     || '') + '\n' +
                 'Email: '    + (params.email     || '') + '\n' +
                 'Interest: ' + (params.interest  || '') + '\n' +
                 'Source: '   + (params.source    || '') + '\n\n' +
                 'Message:\n' + (params.message   || '');
      try { MailApp.sendEmail(NOTIFY_EMAILS, subj, body); } catch (mailErr) {}
    }

    return ContentService
      .createTextOutput(JSON.stringify({ ok: true }))
      .setMimeType(ContentService.MimeType.JSON);

  } catch (err) {
    return ContentService
      .createTextOutput(JSON.stringify({ ok: false, error: String(err) }))
      .setMimeType(ContentService.MimeType.JSON);
  }
}

function doGet() {
  return ContentService
    .createTextOutput('V2 JDA Lead Receiver is live.')
    .setMimeType(ContentService.MimeType.TEXT);
}

function getSheet_() {
  var ss = SPREADSHEET_ID
    ? SpreadsheetApp.openById(SPREADSHEET_ID)
    : SpreadsheetApp.getActiveSpreadsheet();

  var sheet = ss.getSheetByName(SHEET_NAME);
  if (!sheet) sheet = ss.insertSheet(SHEET_NAME);
  return sheet;
}
