# V2 JDA Approved Properties

Custom WordPress theme + Google Sheets lead pipeline for **V2 JDA Approved Properties** — a Jaipur-based real estate firm specialising in JDA & RERA approved plots, villas and farm-house land (in association with the Shyamashish Group).

> **Contact:** Vishal Khandelwal · `+91 75979 61878` · `vishalkhandelwal267@gmail.com`
> **Social:** [Facebook](https://www.facebook.com/share/1Ct7vcFE6Y/) · [YouTube](https://youtube.com/@v2jdaapprovedproperties)

## 🌐 Live preview

A **static HTML preview** of the design runs free on GitHub Pages at:

**https://gromoney111.github.io/V2-JDA-Approved-Properties/**

(Enable Pages once: *Repository → Settings → Pages → Source: "Deploy from a branch" → Branch: `main` → `/ (root)` → Save*. Wait ~1 minute and the URL goes live.)

The preview includes Home, About, Projects, Gallery, Media, Contact and a 404 page — same design and animations as the production WordPress theme. Use it to share with clients before paying for hosting.

> **Note:** GitHub Pages can only run static HTML/CSS/JS — it cannot run WordPress (which needs PHP + MySQL). For the **production** site with the admin dashboard, lead-management, project CPT, etc., follow `docs/INSTALL.md` to install the WordPress theme on real hosting (Hostinger / GoDaddy / Bluehost).

## What's in this repo

```
.
├── index.html, about.html, ...   ← static preview pages (GitHub Pages)
├── wp-theme/v2-jda-properties/   ← the WordPress theme (production)
├── google-apps-script/Code.gs    ← receives leads into Google Sheets
└── docs/
    ├── INSTALL.md                ← step-by-step theme install
    ├── GOOGLE_SHEETS_SETUP.md    ← 5-minute Sheets setup
    └── CONTENT_GUIDE.md          ← how to add projects, photos, SEO copy
```

The static preview pages share the same CSS/JS/logo as the WordPress theme, so any visual change you make in `wp-theme/v2-jda-properties/assets/` automatically updates both the preview and production.

## Features

- **Home, About, Projects, Gallery, Media, Contact** — all six pages auto-created on theme activation.
- **Project custom post type** with `Ongoing / Completed / Upcoming` status taxonomy and per-project meta (price, area, address, RERA #, Google Maps embed, brochure link).
- **Animated, fully responsive UI** — hero zoom, animated counters, scroll-in fade/slide, project hover, lightbox gallery, sticky CTA, WhatsApp + Call floating buttons.
- **Lead capture pipeline** — every contact form submission is:
  1. Saved as a private `Lead` post in WordPress (with name, phone, email, interest, source URL).
  2. Forwarded to Google Sheets via the bundled Apps Script.
  3. Emailed to you.
- **SEO defaults** — meta description, keywords, Open Graph, Twitter card, `RealEstateAgent` JSON-LD. Plays nicely with Yoast / Rank Math when installed.
- **Theme Customizer** — change phone, email, social URLs, hero copy, lead webhook URL without touching code.
- **Original code, no licensing risk** — written from scratch, GPL-2.0-or-later.

## How to download the theme ZIP

WordPress needs a single `.zip` of the theme folder (not the whole repo). Pick whichever option is easiest for you:

### Option A — Download from GitHub Actions (easiest, no tools needed)

After this branch is pushed, GitHub Actions automatically builds `v2-jda-properties.zip` and stores it as a downloadable artifact.

1. Go to **[Actions tab](https://github.com/gromoney111/V2-JDA-Approved-Properties/actions)**.
2. Click the most recent successful "Build theme ZIP" run.
3. Scroll to the **Artifacts** section at the bottom of the page.
4. Click **`v2-jda-properties`** to download the ZIP.

(Artifacts expire after 90 days. To get a permanent copy, push a tag like `v1.0.0` and a GitHub Release will be created with the ZIP attached.)

### Option B — Build it yourself (one command, requires `zip` + bash)

```bash
git clone https://github.com/gromoney111/V2-JDA-Approved-Properties.git
cd V2-JDA-Approved-Properties
bash build-theme-zip.sh
```

This produces `v2-jda-properties.zip` in the repo root, ready to upload.

### Option C — Manual (no tools)

1. Click the green **Code** button on the [repo page](https://github.com/gromoney111/V2-JDA-Approved-Properties), then **Download ZIP**.
2. Unzip what you downloaded.
3. Go inside `wp-theme/`, right-click the `v2-jda-properties` folder, and **Compress** / **Send to → Compressed (zipped) folder**. That ZIP is what you upload to WordPress.

> ⚠️ Don't upload the whole repo ZIP — WordPress will reject it. It needs a ZIP whose top-level folder is `v2-jda-properties/` containing `style.css`, `functions.php`, etc.

## Quick start

1. **Install WordPress** on your hosting.
2. Get the theme ZIP using one of the options above.
3. In WordPress: *Appearance → Themes → Add New → Upload Theme* → upload the ZIP → **Activate**.
4. Open *Appearance → Customize* and fill in the **V2 JDA - Contact**, **Social Links**, **Hero** and **Site Identity (logo)** sections.
5. Follow [`docs/GOOGLE_SHEETS_SETUP.md`](docs/GOOGLE_SHEETS_SETUP.md) (≈ 5 min) to wire up Google Sheets for leads.
6. Add your projects under *Projects → Add New* (see [`docs/CONTENT_GUIDE.md`](docs/CONTENT_GUIDE.md)).

Full instructions: [`docs/INSTALL.md`](docs/INSTALL.md).

## Logo

The theme ships with an SVG default logo (silver/blue ring with "V2", a small house silhouette, and a "JDA APPROVED PROPERTIES" arc). To replace it with your own PNG/JPG/SVG:

1. *Appearance → Customize → Site Identity*.
2. Click **Select logo** and upload your file (recommended size: 200×60 px or square 200×200 px for header use).
3. Click **Publish**.

The same Site Identity panel lets you upload a **Site Icon** (the browser-tab favicon). If you skip it, the bundled gold "V2" SVG icon is used automatically.

## Tech notes

- Pure PHP / vanilla JS / CSS — no build step required.
- WordPress 6.0+, PHP 7.4+.
- External assets (Google Fonts, Font Awesome) loaded from CDN; everything else is local.
- Animations are CSS + a small `IntersectionObserver` — no AOS.js dependency.

## Roadmap / nice-to-haves

These can be added later if you want them:

- reCAPTCHA v3 anti-spam on the lead form.
- A **Testimonials** custom post type so reviews can be added from the admin instead of theme files.
- A **Blog / News** archive for content marketing.
- Hindi translation (the theme is already i18n-ready via `__()` and `Text Domain: v2jda`).
- Real photos and project data — replace the Unsplash placeholders.

## License

GPL-2.0-or-later — same as WordPress core.
