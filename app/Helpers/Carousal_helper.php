<?php

use App\Models\CarousalModel;

if (!function_exists('render_carousal_by_code')) {
    function render_carousal_by_code(string $code): string
    {
        $model = new CarousalModel();
        $images = $model->where('code', $code)->where('status', 1)->findAll();

        if (!$images) {
            return "<p class='text-center text-muted'>No carousel found for code: <b>{$code}</b></p>";
        }

        ob_start(); ?>

        <div id="carousel_<?= esc($code) ?>" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($images as $i => $item): ?>
                    <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                        <img src="<?= base_url('uploads/' . $item['image']) ?>" class="d-block w-100" alt="carousel image"
                            style="object-fit: cover; height: 600px;">
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel_<?= esc($code) ?>"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel_<?= esc($code) ?>"
                data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>

            <!-- Indicators -->
            <div class="carousel-indicators">
                <?php foreach ($images as $i => $item): ?>
                    <button type="button" data-bs-target="#carousel_<?= esc($code) ?>" data-bs-slide-to="<?= $i ?>"
                        class="<?= $i === 0 ? 'active' : '' ?>" aria-current="<?= $i === 0 ? 'true' : 'false' ?>"></button>
                <?php endforeach; ?>
            </div>
        </div>

        <?php
        return ob_get_clean();
    }
}