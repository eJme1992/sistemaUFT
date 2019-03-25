<template>
    <div>
  
     <spinner v-show="cargando"></spinner>
     <table  class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>Nombre</th>
                <th>Fecha de creación</th>
                <th>Fecha de modificación</th>
                <th>#</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha de creación</th>
                <th>Fecha de modificación</th>
                <th>#</th>
            </tr>
        </tfoot>
        <tbody>
           
            <tr v-for="(usuario in usuarios">
                <td>
                    {{usuario.id}}
                </td>
                <td>
                    {{usuario.nombre}} &  {{usuario.apellido}}
                </td>
                <td>
                    {{usuario.correo}}
                </td>
                <td>
                    {{usuario.telefono}}
                </td>
                <td>
                    <a href=""><button class="btn  btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                    <a href=""><button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></button></a>
                    <button class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr> 
        </tbody>
    </table>
      
  </div>
</template>

<script>
    export default {
    data(){
           return{
              usuarios: [],
              cargando: true 
           }
        },
    mounted() {
       axios.get('http://127.0.0.1:8000/usuarioss/1').
       then( (response) => {
        this.usuarios = response.data
        this.cargando = false
        table();
        })
    }
}
</script>
