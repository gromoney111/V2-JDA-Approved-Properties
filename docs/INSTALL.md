# Installing the V2 JDA Approved Properties theme

This is a step-by-step guide for installing the `v2-jda-properties` WordPress theme on a new or existing WordPress site.

## 1. Hosting & domain (one-time)

You need:

- A domain name (e.g. `v2jdaapprovedproperties.com`).
- Web hosting that supports WordPress. Any of these are good options:
  - Hostinger, BigRock, GoDaddy India, Bluehost — typically `₹150–₹400/month`.
  - For best performance: Cloudways, Kinsta, or SiteGround.

Most hosts have a "1-click WordPress install" — use that.

## 2. Install WordPress

If your host did not auto-install WordPress, follow [the official 5-minute install](https://wordpress.org/support/article/how-to-install-wordpress/).

Once installed, log in to the admin at `https://yoursite.com/wp-admin/`.

## 3. Install the theme

1. From this repository, download the `wp-theme/v2-jda-properties` folder as a ZIP. The simplest way:
   - Use this command on your computer:
     ```
     cd wp-theme && zip -r v2-jda-properties.zip v2-jda-properties
     ```
   - Or download the whole repo as a ZIP from GitHub and zip the `v2-jda-properties` folder by itself.
2. In WordPress admin, go to **Appearance → Themes → Add New → Upload Theme**.
3. Choose `v2-jda-properties.zip` and click **Install Now**.
4. Click **Activate**.

The theme will automatically:
- Create the pages **Home, About, Projects, Gallery, Media, Contact**.
- Set "Home" as the front page.
- Add a **Projects** menu and **Leads** menu in the WordPress sidebar.
- Seed the project statuses **Ongoing, Completed, Upcoming**.

## 4. Configure your contact details

Go to **Appearance → Customize**:

| Section | What to set |
|---|---|
| **V2 JDA - Contact** | Phone (display + digits-only), email, address |
| **V2 JDA - Social Links** | Facebook, YouTube, Instagram, WhatsApp URLs |
| **V2 JDA - Hero** | Headline, subheadline and background image for the home page |
| **V2 JDA - Lead Capture** | Google Apps Script URL + notify email (see [`GOOGLE_SHEETS_SETUP.md`](GOOGLE_SHEETS_SETUP.md)) |

Click **Publish** when done.

## 5. Set up the Primary menu

1. Go to **Appearance → Menus**.
2. Create a new menu called "Primary" and add the pages: Home, About, Projects, Gallery, Media, Contact.
3. Tick **Display location → Primary Menu**. Save.

## 6. Add your projects

1. Go to **Projects → Add New** in the WordPress sidebar.
2. For each project:
   - **Title** — e.g. "Greenfield Residency"
   - **Content** — full description
   - **Featured Image** — main project photo
   - **Project Status** (right sidebar) — Ongoing / Completed / Upcoming
   - **Project Details** box (below the editor) — price, area, address, RERA #, Google Maps embed URL, brochure URL
3. Publish.

The project will instantly appear on:
- The **home page** (latest 3, in the "Featured Projects" section)
- The **Projects** page (filtered by status)
- The **Gallery** page (featured images)
- Its own detail page at `/projects/<slug>/`

## 7. Set up Google Sheets for leads

Follow [`GOOGLE_SHEETS_SETUP.md`](GOOGLE_SHEETS_SETUP.md). About 5 minutes.

## 8. SEO basics

The theme already adds:
- Meta description, keywords, Open Graph tags
- `RealEstateAgent` JSON-LD on the home page
- Per-project meta from each Project's content/excerpt

**Recommended additional plugins:**

- **Rank Math** or **Yoast SEO** — for richer SEO controls and XML sitemap (`/sitemap_index.xml`).
- **Akismet** — anti-spam for the Leads form.
- **WP Super Cache** or **LiteSpeed Cache** — page caching.
- **Smush** or **ShortPixel** — image optimisation.

After installing Rank Math / Yoast, the theme's lightweight SEO output will defer to the plugin so there are no duplicate tags.

## 9. Connect Google Search Console & Analytics

1. Create properties in [Search Console](https://search.google.com/search-console) and [GA4](https://analytics.google.com).
2. In Search Console, submit your sitemap (`/sitemap_index.xml` from Rank Math/Yoast).
3. Paste your GA4 measurement ID into Rank Math → General Settings → Analytics.

You're live. See [`CONTENT_GUIDE.md`](CONTENT_GUIDE.md) for ongoing tips on adding photos, testimonials and YouTube videos.
