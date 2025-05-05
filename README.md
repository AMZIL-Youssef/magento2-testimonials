# Magento 2 Testimonials Module

## Installation

1. Clone the repository into your Magento 2 `app/code` directory, ensuring the folder structure respects the naming convention (`app/code/Sda/Testimonials`):
   ```bash
   git clone https://github.com/AMZIL-Youssef/magento2-testimonials.git app/code/Sda/Testimonials
   ```

2. Enable the module:
   ```bash
   php bin/magento module:enable Sda_Testimonials
   ```

3. Run setup upgrade :
   ```bash
   php bin/magento setup:upgrade
   ```

4. Deploy static content:
   ```bash
   php bin/magento setup:static-content:deploy -f
   ```

5. Clear the cache:
   ```bash
   php bin/magento cache:flush
   php bin/magento cache:clean
   ```

---

## Usage

### Frontend

1. **Testimonial Submission Form:**
   - A modal prompts customers to submit testimonials after a successful checkout, ensuring immediate feedback.
   - For testing, the form is also accessible via the `testimonial/testimonialclient/index` route. To remove this route, delete the `index.php` file in `Controller/TestimonialClient/`.
   - Testimonials are saved with a "Pending" status, awaiting admin approval.

2. **Testimonial Carousel:**
   - Displayed at the bottom of the homepage by default.
   - Includes a rating filter and responsive design.

### Admin Panel

1. **Manage Testimonials:**
   - Navigate to `Customers > Customer Testimonials` in the admin menu.
   - Approve, reject, or delete testimonials directly from the grid.

2. **Statistics:**
   - View total testimonials, approved, pending, rejected, and average rating on the admin dashboard.

---

## Support

For issues or feature requests, please open an issue on the [GitHub repository](https://github.com/AMZIL-Youssef/magento2-testimonials).