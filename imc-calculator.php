<?php 
/* 
Plugin Name: IMC Calculator
Plugin URI: https://github.com/mandaloredev/imc-calculator-wordpress 
Description: IMC Calculator WordPress Plugin. Use shortcode: <pre>[calc_imc]</pre>
Version: 1.0
Author: MandoDev
Author URI: https://github.com/mandaloredev
Text Domain: imc-calculator
*/

function imc_calculator_shortcode() {
    ob_start();
    ?>
    <form id="imc-calculator-form">
        <label for="height">Height</label>
        <input type="number" name="height" id="height" step="0.01" min="0" max="300">
        <label for="weight">Weight</label>
        <input type="number" name="weight" id="weight" step="0.01" min="0" max="1000">
        <button type="submit">Calcular</button>
    </form>
    <div id="result"></div>
    <?php
    return ob_get_clean();
}

add_shortcode('calc_imc', 'imc_calculator_shortcode');

function imc_ajax_scripts() {
    wp_enqueue_script('imc-ajax', plugin_dir_url(__FILE__) . 'js/imc-ajax.js', array('jquery'), '1.0', true);
    wp_enqueue_style( 'imc-ajax', plugins_url( 'css/style.css', __FILE__ ) );
    wp_localize_script('imc-ajax', 'imc_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'imc_ajax_scripts');

function imc_ajax_calculator() {
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $imc = $weight / ($height * $height);
    echo $imc;
    wp_die();
}

add_action('wp_ajax_imc_ajax_calculator', 'imc_ajax_calculator');
add_action('wp_ajax_nopriv_imc_ajax_calculator', 'imc_ajax_calculator');