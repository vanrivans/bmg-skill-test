<?php
$alert_class = 'alert m-0';
$content = null;

// Get validation errors
if (function_exists('validation_errors')) {
    if (validation_errors()) {
        echo validation_errors('<div class="' . $alert_class . ' alert-danger">', '</div>');
    }
}

// Get success messages
if ($this->session->flashdata('alert-success')) {
    echo '<div class="' . $alert_class . ' alert-success">' . $this->session->flashdata('alert-success') . '</div><br>';
}

if ($this->session->flashdata('alert-info')) {
    echo '<div class="' . $alert_class . ' alert-info">' . $this->session->flashdata('alert-info') . '</div><br>';
}

if ($this->session->flashdata('alert-error')) {
    echo '<div class="' . $alert_class . ' alert-danger">' . $this->session->flashdata('alert-error') . '</div><br>';
}
