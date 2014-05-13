Field context
=============

Field context module provides a way for developers to reference field instances 
in abstract terms rather than actual field names, allowing you to write a 
future-proof code in cases where exact field names need to be known.

You only need to enabled it if a module depends on it or if you want to 
integrate it in your own development.

Installation
------------

Install it just like any other Drupal module - place it in the modules 
directory for your site and enable it on the "admin/modules" page.

Usage
-----

Note: Although Field context does not have a hard dependency on Field UI
module, you have to enable Field UI (field_ui) module in order to be able to
set contexts for fields via user interface.

A field context can be set in the form that adds or edits field instances for 
any bundle of any entity.

### Nodes

If you wish to add field contexts for node fields:
1. Go to Structure > Content types section of the site (admin/structure/types).
2. Click on "manage fields" link for the content type of your choice.
3. If you do not have defined fields, add a field and select a field context
in the "Field context" section of the field edit form.
4. If you want to add a field context for existing field, click on "edit" link
for selected field and select a field context in the "Field context" section of the
field edit form.

### Users

If you wish to add field contexts for user fields:
1. Go to Configuration > Account settings section of the site
(admin/config/people/accounts).
2. Click on "Manage fields" tab.
3. Select field contexts the same way you would do for node fields.

Predefined contexts
-------------------

For user convenience developers can predefine contexts using hooks to avoid 
manual field context input from the user. See fieldcontext.api.php file for 
examples and documentation.

Integration with Features
-------------------------

All defined field contexts are automatically exported when field instances
are being exported via Features.

Use case
--------

Your client wants to have a website that lists his paintings and drawings, with 
all paintings and drawings with price over € 1000 promoted to the front page 
automatically. Your client also wants to be able to add different types of art 
in the future himself and also have them promoted to the front page using the 
same price threshold.

As a developer, you do the following:

1. Create two node content types: Painting and Drawing.
2. Add a field "Price" (field_painting_price) that is attached to Painting 
content type, and assign "price" context to the field.
3. Add a field "Price" (field_drawing_price) that is attached to Drawing 
content type, and assign "price" context to the field.
4. Create a hook that sets $node->promote to 1 upon node saving if the field 
value with "price" context is greater that 1000.
5. Instruct your client that when he creates a Sculpture node content type and 
adds a field "Price" (field_oh_thisis_f0r_price_right) to the Sculpture content 
type himself in the future, he merely needs to select "Price" context for the 
field in order to have expensive sculptures promoted to the front page.
