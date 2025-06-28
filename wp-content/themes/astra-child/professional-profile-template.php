<?php
/**
 * Template Name: Professional Profile
 * Description: Custom template for Brandon's professional profile page
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <section class="profile-hero">
            <div class="profile-container">
                <div class="profile-image">
                    <?php 
                    $profile_img = get_theme_mod('profile_image', get_template_directory_uri().'/assets/images/profile-default.jpg');
                    echo '<img src="'.esc_url($profile_img).'" alt="'.esc_attr(get_bloginfo('name')).'">';
                    ?>
                </div>
                <div class="profile-content">
                    <h1><?php echo esc_html(get_theme_mod('profile_name', 'Brandon Brenes Arias')); ?></h1>
                    <p class="profile-title"><?php echo esc_html(get_theme_mod('profile_title', 'Diseñador & Desarrollador - Tazas Personalizadas')); ?></p>
                    
                    <div class="profile-bio">
                        <?php 
                        $bio = get_theme_mod('profile_bio', 'Desarrollador Full Stack y diseñador multidisciplinario con pasión por crear experiencias digitales únicas y productos personalizados. Combino habilidades técnicas en programación con visión creativa para desarrollar desde aplicaciones web hasta tazas personalizadas con diseños innovadores.');
                        echo wpautop(esc_textarea($bio));
                        ?>
                    </div>
                    
                    <div class="profile-skills">
                        <?php
                        $skills = get_theme_mod('profile_skills', ['Diseño UI/UX', 'Desarrollo Web', 'Personalización', 'Tecnología QR']);
                        if(is_array($skills)) {
                            foreach($skills as $skill) {
                                echo '<span class="skill-tag">'.esc_html($skill).'</span>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="profile-projects">
            <h2>Mis Proyectos</h2>
            <div class="projects-grid">
                <?php
                $projects = new WP_Query(array(
                    'post_type' => 'project',
                    'posts_per_page' => 4,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                
                if($projects->have_posts()) : 
                    while($projects->have_posts()) : $projects->the_post(); 
                        $project_type = get_post_meta(get_the_ID(), 'project_type', true);
                        ?>
                        <article class="project-card <?php echo esc_attr($project_type); ?>">
                            <a href="<?php the_permalink(); ?>">
                                <?php if(has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium'); ?>
                                <?php endif; ?>
                                <div class="project-info">
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php echo esc_html(get_post_meta(get_the_ID(), 'project_short_desc', true)); ?></p>
                                </div>
                            </a>
                        </article>
                    <?php 
                    endwhile; 
                    wp_reset_postdata();
                else : ?>
                    <p>No projects found.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>
</div>

<?php
get_footer();
?>