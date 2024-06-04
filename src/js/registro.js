import Swal from "sweetalert2";

(function () {
  let eventos = [];
  const eventosBoton = document.querySelectorAll(".evento__agregar");
  const resumen = document.querySelector("#registro-resumen");

  if (resumen) {
    eventosBoton.forEach((boton) =>
      boton.addEventListener("click", seleccionarEvento)
    );

    const formularioRegistro = document.querySelector("#registro");
    formularioRegistro.addEventListener("submit", submitFormulario);

    mostrarEventos();

    function seleccionarEvento({ target }) {
      if (eventos.length < 5) {
        // Deshabilitar el evento
        target.disabled = true;

        eventos = [
          ...eventos,
          {
            id: target.dataset.id,
            titulo: target.parentElement
              .querySelector(".evento__nombre")
              .textContent.trim(),
          },
        ];

        mostrarEventos();
      } else {
        //   alert("Solo un máximo de 5 eventos");
        Swal.fire({
          title: "Error",
          text: "Máximo 5 eventos por registro",
          icon: "error",
          confirmButtonText: "OK",
        });
      }
    }
    function mostrarEventos() {
      //Limpiar HTML
      limpiarEventos();
      if (eventos.length > 0) {
        eventos.forEach((evento) => {
          const eventoDOM = document.createElement("DIV");
          eventoDOM.classList.add("registro__evento");
          const titulo = document.createElement("H3");
          titulo.classList.add("registro__nombre");
          titulo.textContent = evento.titulo;

          const botonEliminar = document.createElement("BUTTON");
          botonEliminar.classList.add("registro__eliminar");
          botonEliminar.innerHTML = `<i class="fa-solid fa-trash"></i>`;
          botonEliminar.onclick = function () {
            eliminarEvento(evento.id); //Asi cuando quiero pasar arguemntos a la funcion sino solo el nombre
          };

          eventoDOM.appendChild(titulo);
          eventoDOM.appendChild(botonEliminar);
          resumen.appendChild(eventoDOM);
        });
      } else {
        const noRegistros = document.createElement("P");
        noRegistros.textContent =
          "No hay eventos, añade hasta 5 del lado izquierdo";
        noRegistros.classList.add("registro__texto");
        resumen.appendChild(noRegistros);
      }
    }

    function eliminarEvento(id) {
      // console.log(id);
      eventos = eventos.filter((evento) => evento.id !== id);
      const botonAgregar = document.querySelector(`[data-id="${id}"]`);
      botonAgregar.disabled = false;
      mostrarEventos();
    }

    function limpiarEventos() {
      while (resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
      }
    }

    async function submitFormulario(e) {
      e.preventDefault();

      //Obtener regalo
      const regaloId = document.querySelector("#regalo").value;

      const eventosId = eventos.map((evento) => evento.id);

      if (eventosId.length === 0 || regaloId === "") {
        Swal.fire({
          title: "Error",
          text: "Elige al menos un evento y un regalo",
          icon: "error",
          confirmButtonText: "OK",
        });
        return;
      }

      // Objeto de form data
      const datos = new FormData();
      datos.append("eventos", eventosId);
      datos.append("regalo_id", regaloId);

      const url = "/finalizar-registro/conferencias";
      const respuesta = await fetch(url, {
        method: "POST",
        body: datos,
      });

      const resultado = await respuesta.json();

      if (resultado.resultado) {
        Swal.fire({
          title: "Registro Exitoso",
          text: "Tus conferencias se han almacenado y tu registro fue exitoso, te esperamos en devwebcamp",
          icon: "success",
        }).then(() => (location.href = `/boleto?id=${resultado.token}`));
        return;
      } else {
        Swal.fire({
          title: "Error",
          text: "Hubo un error",
          icon: "error",
          confirmButtonText: "OK",
        }).then(() => location.reload());
      }
    }
  }
})();
