<main class="devwebcamp">
    <h2 class="devwebcamp__heading"><?php echo $titulo; ?></h2>

    <p class="devwebcamp__descripcion">Conoce la conferencia más importante de latinoamérica</p>

    <div class="devwebcamp__grid">
        <div <?php aos_animacion() ?> class="devwebcamp__imagen">
            <picture>
                <source srcset="build/img/sobre_devwebcamp.avif" type="image/avif">
                <source srcset="build/img/sobre_devwebcamp.webp" type="image/webp">
                <img loading="lazy" width="200" height="300" src="build/img/sobre_devwebcamp.jpg"
                    alt="Imagen devwebcamp">
            </picture>
        </div>

        <div class="devwebcamp__contenido">
            <p <?php aos_animacion(); ?> class="devwebcamp__texto">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rerum labore beatae nostrum distinctio eum
                dignissimos minus fugiat dolorem, vitae ut quisquam libero quos aperiam molestias cupiditate fugit
                doloremque similique laboriosam.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim tempora delectus repellat aliquid fuga,
                suscipit vitae incidunt ut sequi et quisquam distinctio autem possimus, id magnam sed iusto quas. Id.
            </p>

            <p <?php aos_animacion(); ?> class="devwebcamp__texto">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rerum labore beatae nostrum distinctio eum
                dignissimos minus fugiat dolorem, vitae ut quisquam libero quos aperiam molestias cupiditate fugit
                doloremque similique laboriosam.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt exercitationem eum doloribus rem quasi
                dolor tempora accusantium, odio ea, eveniet tempore nemo aliquid incidunt consequuntur autem ipsum
                repellendus fugiat! Sint.
            </p>
        </div>
    </div>
</main>