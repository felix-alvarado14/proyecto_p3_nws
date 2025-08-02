<section class="depth-2 px-4 py-5">
  <h2>{{modeDsc}}</h2>
</section>

<section class="depth-2 px-4 py-4 my-4 grid row">
  <form
    method="POST"
    action="index.php?page=Maintenance-Admin-Roles-Rol&mode={{mode}}&rolescod={{rolescod}}"
    class="grid col-12 col-m-8 offset-m-2 col-l-6 offset-l-3"
  >
    <!-- ID del rol -->
    <div class="row my-2">
      <label for="rolescod_display" class="col-12 col-m-4 col-l-3">ID:</label>
      <input
        type="text"
        id="rolescod_display"
        value="{{rolescod}}"
        class="col-12 col-m-8 col-l-9"
        readonly
      />
      <input type="hidden" name="rolescod" value="{{rolescod}}" />
      <input type="hidden" name="xsrtoken" value="{{xsrtoken}}" />
    </div>

    <!-- Descripción -->
    <div class="row my-2">
      <label for="rolesdsc" class="col-12 col-m-4 col-l-3">Descripción:</label>
      <input
        type="text"
        name="rolesdsc"
        id="rolesdsc"
        value="{{rolesdsc}}"
        placeholder="Nombre del rol"
        class="col-12 col-m-8 col-l-9"
        {{readonly}}
      />
      {{foreach errors_rolesdsc}}
        <div class="error col-12">{{this}}</div>
      {{endfor errors_rolesdsc}}
    </div>

    <!-- Estado -->
    <div class="row my-2">
      <label for="rolesest" class="col-12 col-m-4 col-l-3">Estado:</label>
      <select
        name="rolesest"
        id="rolesest"
        class="col-12 col-m-8 col-l-9"
        {{readonly}}
      >
        <option value="ACT" {{ifeq rolesest "ACT"}}selected{{endifeq}}>Activo</option>
        <option value="INA" {{ifeq rolesest "INA"}}selected{{endifeq}}>Inactivo</option>
      </select>
      {{foreach errors_rolesest}}
        <div class="error col-12">{{this}}</div>
      {{endfor errors_rolesest}}
    </div>

    <!-- Botones -->
    <div class="row">
      <div class="col-12 right">
        <button class="secondary" id="btnCancel" type="button">{{cancelLabel}}</button>
        &nbsp;
        {{if showConfirm}}
          <button class="primary" type="submit" id="btnSubmit">Confirmar</button>
        {{endif showConfirm}}
      </div>
    </div>

    <!-- Errores globales -->
    {{if errors_global}}
      <div class="row">
        <ul class="col-12">
          {{foreach errors_global}}
            <li class="error">{{this}}</li>
          {{endfor errors_global}}
        </ul>
      </div>
    {{endif errors_global}}
  </form>
</section>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const cancelBtn = document.getElementById("btnCancel");
    const submitBtn = document.getElementById("btnSubmit");

    cancelBtn?.addEventListener("click", (e) => {
      e.preventDefault();
      window.location.assign("index.php?page=Maintenance-Admin-Roles-Roles");
    });

    submitBtn?.addEventListener("click", () => {
      submitBtn.disabled = true;
      submitBtn.innerText = "Procesando...";
    });
  });
</script>