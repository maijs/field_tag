Field context
-------------
by maijs, miro@apollo.lv

Field context module provides a way for developers to reference field instances in abstract terms rather than actual field names, allowing your code to be applied to the fields that will created in the future by you or your clients.

You only need to enabled it if a module depends on it or if you want to integrate it in your own development.

Use case
========
Your client wants to have a website that lists his paintings and drawings on the website, having all paintings and drawings with price over € 1000 promoted to the front page automatically. Your client also wants to be able to add different types of art in the future himself and also have them promoted to the front page with the same condition.

As a developer, you do the following:

1. Create two node content types: Painting and Drawing.
2. Add a field "Price" (field_painting_price) that is attached to Painting content type, and assign "price" context to the field.
3. Add a field "Price" (field_drawing_price) that is attached to Drawing content type, and assign "price" context to the field.
4. Create a hook that sets $node->promoted to 1 upon node saving if the field value with "price" context is greater that 1000.
5. Instruct your client that when he creates a Sculpture node content type and adds a field "Price" (field_oh_thisis_f0r_price_right) to the Sculpture content type himself in the future, he merely needs to select "Price" context for the field in order to have expensive sculptures promoted to the front page.
