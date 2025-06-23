<?php
if (!defined('ABSPATH')) {
    exit;
} ?>

<?php astra_content_bottom(); ?>
</div> <!-- ast-container -->
</div><!-- #content -->
<?php
astra_content_after(); ?>

<footer class="custom-footer">
    <div class="footer-container">
        <div class="footer-section">
            <div class="footer-logo"><?php
            if (has_custom_logo()) {
                the_custom_logo();
            }
            ?></div>
            <p>Endulzamos tus momentos con sabor y color. 🍩</p>
        </div>
        <div class="footer-section">
            <h4>Enlaces</h4>
            <nav class="footer-links">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-menu',
                    'container' => false,
                    'menu_class' => 'footer-menu',
                    'depth' => 1
                ));
                ?>
            </nav>
        </div>

        <div class="footer-section">
            <h4>Redes Sociales</h4>
            <ul>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Instagram</a></li>
                <li><a href="#">TikTok</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Contacto</h4>
            <p>📍 #123, Calle Dulce de distrito Leche</p>
            <p>📞 (+506) 8456-7890</p>
            <p>✉️ contacto@dondonas.com</p>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© 2025 Don Donas. Todos los derechos reservados.</p>
    </div>
</footer>

</div><!-- #page -->
<?php astra_body_bottom();
wp_footer(); ?>
</body>

</html>