# Connecting the contact form to Google Sheets

Every enquiry submitted via the website's contact form will be:

1. Saved inside WordPress under **Leads** (always).
2. Emailed to your inbox (always).
3. **Appended to a Google Sheet** (after this 5-minute setup).

## Step 1 — Create the spreadsheet

1. Go to [https://sheets.google.com](https://sheets.google.com).
2. Click the **+ Blank** sheet.
3. Rename it to: **V2 JDA - Leads**.

## Step 2 — Open Apps Script

1. In your new spreadsheet, click **Extensions → Apps Script**.
2. A new browser tab opens with a code editor.
3. Delete any default `function myFunction() {}` code.

## Step 3 — Paste the receiver script

1. From this repository open the file `google-apps-script/Code.gs`.
2. Copy its **entire** contents.
3. Paste into the Apps Script editor.
4. (Optional) On line `var NOTIFY_EMAILS = '...'`, change the e-mail to whatever address you want a copy of every lead to go to.
5. Click the floppy-disk **Save** icon (or `Ctrl/Cmd + S`).

## Step 4 — Deploy as Web App

1. In Apps Script, click **Deploy → New deployment**.
2. Click the gear icon → **Web app**.
3. Fill in:
   - **Description:** `V2 JDA Lead Receiver`
   - **Execute as:** `Me`
   - **Who has access:** `Anyone`
4. Click **Deploy**.
5. Apps Script will ask for permissions — click **Authorize**, choose your Google account, and click **Allow**.
6. Copy the **Web app URL** that appears. It looks like:

   ```
   https://script.google.com/macros/s/AKfycbz.../exec
   ```

## Step 5 — Paste the URL into WordPress

1. In your WordPress admin, go to **Appearance → Customize → V2 JDA - Lead Capture**.
2. Paste the Web app URL into **Google Apps Script Web App URL**.
3. Click **Publish**.

## Step 6 — Test it

1. Open your site's `/contact/` page in an incognito window.
2. Fill in the form with a fake name + your phone number.
3. Submit.

Within a few seconds you should see:

- A success message on the form.
- A new row in your **V2 JDA - Leads** Google Sheet.
- An e-mail in your inbox.
- A new entry under **Leads** in WordPress admin.

## Updating the script

If you ever change the Apps Script code:

1. Save the script (`Ctrl/Cmd + S`).
2. Click **Deploy → Manage deployments**.
3. Click the pencil icon on your existing deployment.
4. Change **Version** to **New version** and click **Deploy**. Your existing URL keeps working.

## Troubleshooting

| Symptom | Fix |
|---|---|
| Lead arrives in WordPress but not in the sheet | Check Customize → V2 JDA - Lead Capture URL is exactly the deployed `/exec` URL. Open it in a browser — you should see "V2 JDA Lead Receiver is live." |
| "You need access" message when opening the URL | In Apps Script → Manage deployments, set **Who has access** to **Anyone**. |
| Sheet rows are blank | Confirm the Web app URL ends in `/exec`, not `/dev`. |
| Spam submissions | Install Akismet, or add reCAPTCHA v3 (we can wire it up later if needed). |
