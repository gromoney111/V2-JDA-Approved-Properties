# Adding content to the site

This guide walks through adding the everyday content of the website: projects, photos, testimonials, videos, and SEO copy.

## Adding a project

1. **Projects → Add New** in WordPress admin.
2. Fill in:
   - **Title** — the project name (e.g. "Greenfield Residency").
   - **Content** — 2–4 paragraphs describing the project. Highlight USPs (location, plot sizes, amenities, approvals).
   - **Featured Image** (right sidebar) — the main "hero" photo of the project. Upload at least 1200×900 px.
   - **Project Status** — tick **Ongoing**, **Completed**, or **Upcoming**.
   - **Locations** (taxonomy) — add area like *Ajmer Road*, *Tonk Road*. Helps SEO.
3. Scroll down to the **Project Details** box and fill in:
   - **Starting Price** — e.g. `₹25 Lakh onwards`
   - **Plot Area / Size** — e.g. `100–300 Sq. Yd.`
   - **Address / Location** — full address
   - **RERA / JDA Approval Number** — exact number from the certificate
   - **Google Maps Embed URL** — open Google Maps → Share → Embed a map → copy the **src** from the iframe
   - **Brochure URL** — upload the PDF brochure under Media → Library, then copy its URL here
4. Click **Publish**.

The project shows up immediately on the home page (latest 3) and on the Projects page (filterable).

## Adding photos to the gallery

The Gallery page automatically pulls **Featured Images** from your Projects.

If you want extra photos that aren't tied to a specific project, the easiest way is:

1. Edit the Gallery page (Pages → Gallery).
2. Insert the WordPress **Gallery** block above the project gallery and add your photos there.

## Adding a customer testimonial

Right now testimonials are baked into the home page (`front-page.php`).

To replace the placeholder reviews with real ones:

1. Open `wp-content/themes/v2-jda-properties/front-page.php` via FTP, or use **Appearance → Theme File Editor**.
2. Find the `$reviews = array(...)` block.
3. Replace each row with `array( 'INITIALS', 'Customer Name', 'Customer Role/Location', 'Their review text...' )`.
4. Save.

(For a more user-friendly setup we can later move testimonials to a custom post type — let us know.)

## Adding YouTube videos to the Media page

1. Open the file `wp-content/themes/v2-jda-properties/page-templates/template-media.php`.
2. Find the `$videos = array(...)` block.
3. Replace `dQw4w9WgXcQ` and `ScMzIvxBSi4` with your real YouTube video IDs (the part after `?v=` in the YouTube URL).
4. Add as many rows as you need.

Alternatively, use the **YouTube** block in the WordPress block editor on the Media page itself — paste a YouTube URL and it will auto-embed.

## SEO: what to write where

### Page titles & descriptions

- **Home page** — set under **Settings → General**:
  - **Site Title:** `V2 JDA Approved Properties | RERA Approved Plots in Jaipur`
  - **Tagline:** *(used as homepage description)* — e.g. `JDA & RERA approved residential plots, villas and farm-house land in Jaipur.`
- **Other pages** — open each page's **Excerpt** field and write a 150-character description.

### Keywords to target

Already targeted in the theme:

- JDA approved plots Jaipur
- RERA approved properties Jaipur
- Residential plots Jaipur
- Farm house land Jaipur
- Property dealer Jaipur

For each project, naturally include the area name and "JDA approved" / "RERA approved" in the description.

### Image SEO

When uploading photos:

- **Filename:** rename before upload — e.g. `greenfield-residency-ajmer-road-jaipur.jpg`
- **Alt text:** describe in plain English — e.g. *"Aerial view of Greenfield Residency JDA approved plots near Ajmer Road, Jaipur"*

### Local SEO

1. Create a **Google Business Profile** at [business.google.com](https://business.google.com).
   - Category: **Real estate agency**
   - Phone: `+91 75979 61878`
   - Add 5–10 project photos.
2. Get listed on **JustDial**, **Sulekha**, **99acres**, **MagicBricks**.
3. Ask happy customers to leave a Google review.

## Backups

After populating content, install the **UpdraftPlus** plugin and configure weekly backups to Google Drive. Free.
