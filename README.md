# Brewhaus — WordPress Coffee Shop Theme

A rich, artisan WordPress theme for coffee shops. Built with classic PHP templates (no Gutenberg dependency), custom post types, and a warm editorial design system.

## Features

- **Custom Post Types**: Menu Items, Testimonials, Specials — all manageable from the WP admin
- **Custom Taxonomy**: Menu Categories (Espresso, Drip, Cold Brew, Food, etc.)
- **Customizer Settings**: Address, phone, hours, social links, hero tagline, show/hide sections
- **Homepage Sections**: Hero, Intro, Menu Tabs, Story, Specials, Gallery, Testimonials, Blog Posts, Hours, Newsletter
- **Page Templates**: Front Page, Full Menu, Contact
- **Static Fallbacks**: Every section works out of the box with placeholder content — just add real content as you go
- **Responsive**: Mobile-first, hamburger nav, fluid typography
- **Performance**: Minimal dependencies (Google Fonts only), no jQuery required

## Installation

1. Copy the `brewhaus-theme` folder into `/wp-content/themes/`
2. Activate from **Appearance → Themes**
3. Set your **Homepage**: Settings → Reading → A static page → select "Home"
4. Assign the **Front Page** template to your homepage
5. Create a menu in **Appearance → Menus** and assign to "Primary Navigation"

## Page Templates

| Template | Usage |
|---|---|
| Front Page | Assign to homepage |
| Full Menu Page | Create a page called "Menu" |
| Contact Page | Create a page called "Contact" |
| Default | About, Blog, etc. |

## Customizer

Go to **Appearance → Customize → Coffee Shop Info** to set:
- Address, phone, email
- Hero tagline and story quote
- Social media links (Instagram, Facebook, Twitter, TikTok)
- Toggle newsletter and gallery sections

## Adding Menu Items

1. Go to **Menu Items → Add New**
2. Enter the drink/food name and description
3. Fill in price in the "Menu Item Details" box
4. Assign to a Menu Category (create categories under Menu Items → Menu Categories)
5. Check "Show on homepage" to feature it in Specials

## Adding Testimonials

1. Go to **Testimonials → Add New**
2. Write the review text in the content box
3. Fill in customer name, rating, and source in the meta box

## Required Plugins (Optional)

- **Contact Form 7** — for the contact page form with spam protection
- **Yoast SEO** — for SEO meta tags

## Theme Colors

| Variable | Value | Usage |
|---|---|---|
| `--cream` | `#F5EFE0` | Page background |
| `--espresso` | `#1C0F07` | Primary dark |
| `--gold` | `#C48A3F` | Accent color |
| `--caramel` | `#A0622A` | Secondary accent |
| `--roast` | `#3B1F0E` | Mid-tone brown |
