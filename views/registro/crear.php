<main class="registro">
    <h2 class="registro__heading"><?php echo $titulo; ?></h2>
    <p class="registro__descripcion">Elige tu plan</p>

    <div class="paquetes__grid">
        <div class="paquete">
            <h3 class="paquete__nombre">Pase gratis</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso virtual a devwebcamp</li>
            </ul>

            <p class="paquete__precio">$0</p>

            <form action="/finalizar-registro/gratis" method="POST">
                <input type="submit" class="paquetes__submit" value="Inscripción Gratis">
            </form>
        </div>

        <div class="paquete">
            <h3 class="paquete__nombre">Pase presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso presencial a devwebcamp</li>
                <li class="paquete__elemento">Pase por dos días</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las grabaciones</li>
                <li class="paquete__elemento">Camiseta del evento</li>
                <li class="paquete__elemento">Comida y bebida</li>
            </ul>

            <p class="paquete__precio">$199</p>

            <div id="smart-button-container">
                <div style="text-align: center;">
                    <div id="paypal-button-container"></div>
                </div>
            </div>

        </div>

        <div class="paquete">
            <h3 class="paquete__nombre">Pase virtual</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso vitual a devwebcamp</li>
                <li class="paquete__elemento">Pase por dos días</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las grabaciones</li>
            </ul>

            <p class="paquete__precio">$49</p>

            <div id="smart-button-container">
                <div style="text-align: center;">
                    <div id="paypal-button-container-virtual"></div>
                </div>
            </div>

        </div>
    </div>
</main>


<script
    src="https://www.paypal.com/sdk/js?client-id=<?php echo $_ENV['PAYPAL_CLIENT_ID']; ?>&components=buttons"></script>

<script>
    function initPayPalButton() {
        paypal
            .Buttons({
                style: {
                    shape: "rect",
                    color: "blue",
                    layout: "vertical",
                    label: "pay",
                },

                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [
                            {
                                description: "1",
                                amount: { currency_code: "USD", value: 199 },
                            },
                        ],
                    });
                },

                onApprove: function (data, actions) {
                    return actions.order.capture().then(function (orderData) {
                        //   // Full available details
                        //   console.log(
                        //     "Capture result",
                        //     orderData,
                        //     JSON.stringify(orderData, null, 2)
                        //   );
                        // Show a success message within this page, e.g.
                        //   const element = document.getElementById("paypal-button-container");
                        //   element.innerHTML = "";
                        //   element.innerHTML = "<h3>Thank you for your payment!</h3>";
                        // Or go to another URL:  actions.redirect('thank_you.html');

                        // Guardar el pago en nuestra BD
                        const datos = new FormData();
                        datos.append("paquete_id", orderData.purchase_units[0].description);
                        datos.append(
                            "pago_id",
                            orderData.purchase_units[0].payments.captures[0].id
                        );

                        fetch("/finalizar-registro/pagar", {
                            method: "POST",
                            body: datos,
                        })
                            .then((respuesta) => respuesta.json())
                            .then((resultado) => {
                                //   console.log(resultado);
                                if (resultado.resultado) {
                                    actions.redirect(
                                        "http://localhost:3000/finalizar-registro/conferencias"
                                    );
                                }
                            });
                    });
                },

                onError: function (err) {
                    console.log(err);
                },
            })
            .render("#paypal-button-container");


        // Pase Virtual
        paypal
            .Buttons({
                style: {
                    shape: "rect",
                    color: "blue",
                    layout: "vertical",
                    label: "pay",
                },

                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [
                            {
                                description: "2",
                                amount: { currency_code: "USD", value: 49 },
                            },
                        ],
                    });
                },

                onApprove: function (data, actions) {
                    return actions.order.capture().then(function (orderData) {

                        // Guardar el pago en nuestra BD
                        const datos = new FormData();
                        datos.append("paquete_id", orderData.purchase_units[0].description);
                        datos.append(
                            "pago_id",
                            orderData.purchase_units[0].payments.captures[0].id
                        );

                        fetch("/finalizar-registro/pagar", {
                            method: "POST",
                            body: datos,
                        })
                            .then((respuesta) => respuesta.json())
                            .then((resultado) => {
                                //   console.log(resultado);
                                if (resultado.resultado) {
                                    actions.redirect(
                                        "http://localhost:3000/finalizar-registro/conferencias"
                                    );
                                }
                            });
                    });
                },

                onError: function (err) {
                    console.log(err);
                },
            })
            .render("#paypal-button-container-virtual");
    }

    initPayPalButton();

</script>