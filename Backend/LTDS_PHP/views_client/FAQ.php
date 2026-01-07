<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ/Latiendadelseis</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/FAQ.css">
</head>



<body>
<!-- ===== HEADER ===== -->
<?php include __DIR__ . '/partials/header.php'; ?>










<!-- SECCIÓN FAQ -->
<section class="faq-section py-5">
    <div class="container">
        <h2 class="text-center mb-4 text-light fw-bold">Preguntas Frecuentes</h2>

        <div class="accordion" id="faqAccordion">

            <!-- 1 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="q1">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a1">
                        ¿Los perfumes que venden son originales?
                    </button>
                </h2>
                <div id="a1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Sí, todos nuestros perfumes son 100% originales y provienen directamente de distribuidores autorizados. No manejamos imitaciones ni testers.
                    </div>
                </div>
            </div>

            <!-- 2 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="q2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a2">
                        ¿Manejan perfumes para hombre y para mujer?
                    </button>
                </h2>
                <div id="a2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Sí. Disponemos de una amplia variedad de perfumes para hombre, mujer y unisex, incluyendo fragancias clásicas, nuevas y ediciones especiales.
                    </div>
                </div>
            </div>

            <!-- 3 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="q3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a3">
                        ¿Cómo sé si un perfume es adecuado para mí?
                    </button>
                </h2>
                <div id="a3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        En cada producto encontrarás una descripción detallada con notas olfativas, tipo de fragancia y recomendaciones de uso. Nuestro equipo puede asesorarte si lo necesitas.
                    </div>
                </div>
            </div>

            <!-- 4 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="q4">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a4">
                        ¿Las zapatillas que venden son originales?
                    </button>
                </h2>
                <div id="a4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Sí, todas nuestras zapatillas son originales, nuevas y vienen en su caja completa con sus accesorios.
                    </div>
                </div>
            </div>

            <!-- 5 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="q5">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a5">
                        ¿Qué tallas de zapatillas manejan?
                    </button>
                </h2>
                <div id="a5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Normalmente ofrecemos tallas desde 35 a 46 europeo. En cada producto encontrarás una guía de tallas para elegir correctamente.
                    </div>
                </div>
            </div>

            <!-- 6 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="q6">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a6">
                        ¿Qué métodos de pago aceptan?
                    </button>
                </h2>
                <div id="a6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Aceptamos pagos con tarjeta de crédito/débito, transferencias bancarias y plataformas digitales según tu país.
                    </div>
                </div>
            </div>

            <!-- 7 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="q7">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a7">
                        ¿Cuánto tarda en llegar mi pedido?
                    </button>
                </h2>
                <div id="a7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Generalmente entre 2 y 7 días hábiles, dependiendo de tu ubicación.
                    </div>
                </div>
            </div>

            <!-- 8 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="q8">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a8">
                        ¿Puedo devolver o cambiar un producto?
                    </button>
                </h2>
                <div id="a8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Sí, aceptamos cambios y devoluciones si el producto está nuevo y con empaques completos. En perfumes no se aceptan devoluciones si el sello está roto.
                    </div>
                </div>
            </div>

            <!-- 9 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="q9">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a9">
                        ¿Ofrecen garantía en las zapatillas?
                    </button>
                </h2>
                <div id="a9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Sí, cubrimos defectos de fábrica dentro del periodo de garantía.
                    </div>
                </div>
            </div>

            <!-- 10 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="q10">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a10">
                        ¿Cómo puedo rastrear mi pedido?
                    </button>
                </h2>
                <div id="a10" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Al enviarse tu compra, recibirás un número de seguimiento para monitorear el envío.
                    </div>
                </div>
            </div>

            <!-- 11 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="q11">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a11">
                        ¿Hacen envíos internacionales?
                    </button>
                </h2>
                <div id="a11" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Depende de tu región. El sistema mostrará si tu país está disponible antes de finalizar la compra.
                    </div>
                </div>
            </div>

            <!-- 12 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="q12">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a12">
                        ¿Puedo recibir asesoría antes de comprar?
                    </button>
                </h2>
                <div id="a12" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Claro que sí, puedes escribirnos por WhatsApp, correo o redes sociales para asesoría personalizada.
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>








<!-- ===== FOOTER ===== -->
<?php include __DIR__ . '/partials/footer.php'; ?>





        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>