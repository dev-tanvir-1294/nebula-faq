#  Nebula FAQ Shortcode Generator Plugin – Documentation

## 1. Plugin Overview
The FAQ Shortcode Generator is a WordPress plugin that allows administrators to create a simple
FAQ section from the WordPress dashboard.
The plugin generates a shortcode which can be placed inside any page or post to display the FAQ
content.

## 2. Features
• Simple admin interface
• Generate FAQ section using shortcode
• Clean frontend display
• Works with any WordPress theme

## 3. Installation
1. Download the plugin ZIP file.
2. Go to WordPress Dashboard.
3. Navigate to Plugins → Add New.
4. Click Upload Plugin.
5. Upload the ZIP file.
6. Click Install Now.
7. Activate the plugin.

## 4. How to Use
1. After activation, go to FAQ Generator in the WordPress admin menu.
2. Enter the Page Name.
3. Enter the FAQ Title.
4. Enter the FAQ Description.
5. Click Generate Shortcode.
6. Copy the shortcode below the form.
7. Paste the shortcode into any page or post.

## 5. Shortcode
The plugin provides the following shortcode:
[faq_section]
When this shortcode is added to a page or post, it will display the FAQ title and description entered
in the admin panel.

## 6. File Description
faq-shortcode-generator.php
Main plugin loader file that includes other plugin components.
admin-page.php
Creates the admin dashboard page where users input FAQ information.
form-handler.php
Processes and saves the form data submitted from the admin page.
shortcode.php
Registers the shortcode and displays the FAQ content on the frontend.

## 8. Requirements
• WordPress 5.0 or higher
• PHP 7.0 or higher

## 9. Author
Author: Tanvir
Plugin Type: Custom WordPress Plugin