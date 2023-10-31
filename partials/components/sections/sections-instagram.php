<div class="page-margin instagram">
    <h2 class="instagram-header">Følg med på vores instagram</h2>
    <div class="secondary-gradient-border"></div>
    <?php echo do_shortcode('[insta-gallery id="0"]');
        ?>
    <div class="secondary-gradient-border"></div>
</div>

<script>
        // JavaScript to hide Instagram gallery items with data-feed-item-index greater than 4
        document.addEventListener('DOMContentLoaded', function() {
            const galleryItems = document.querySelectorAll('.instagram-gallery-item');
            galleryItems.forEach(function(item) {
                const index = parseInt(item.getAttribute('data-feed-item-index'), 10);
                if (index > 4) {
                    item.style.display = 'block';
                }
            });
        });
    </script>