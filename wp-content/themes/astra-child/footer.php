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
        <div class="footer-section logo-slogan">
            <div class="footer-logo"><?php
            if (has_custom_logo()) {
                the_custom_logo();
            }
            ?></div>
            <h4 class="eslogan-footer">Haz que tu taza sea especial</h4>
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
            <h4>Contactos</h4>
            <ul>
                <li><a href="#">Correo</a></li>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Instagram</a></li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© 2025 Brandon Brenes Arias. Todos los derechos reservados.</p>
    </div>
</footer>

</div><!-- #page -->
<?php astra_body_bottom();
wp_footer(); ?>
</body>

</html>