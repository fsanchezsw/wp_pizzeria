<h3>Realiza una reserva</h3>
<form class="contact-reservation" method="post">
  <div class="field">
    <label for="name">Nombre *</label>
    <input type="text" name="name" required>
  </div>
  <div class="field">
    <label for="reservation_date">Fecha *</label>
    <input type="datetime-local" name="reservation_date" required>
  </div>
  <div class="field">
    <label for="email">Correo *</label>
    <input type="email" name="email" required>
  </div>
  <div class="field">
    <label for="phone">Teléfono *</label>
    <input type="phone" name="phone" required>
  </div>
  <div class="field">
    <label for="message">Mensaje</label>
    <textarea name="message"></textarea>
  </div>
  <input type="submit" name="Enviar" class="contact-form-button">
</form>
