<?php 
class  OwnerView{
   public function showOwners($owners){
    require './templates/header.php' ;
    ?>
    <!--el controler me envia los dusenios que el modelo pidio a la DB-->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Dueños</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-header">
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($owners as $owner): ?>
                    <tr>
                        <td><?php echo $owner->name ?> </td>
                        <td><?php echo $owner->phone ?> </td>
                        <td><?php echo $owner->email ?> </td>
                        <td><a class="btn btn-danger" href="deleteOwner/<?php echo $owner->id_owner?>">Eliminar</a></td>
                    </tr>
                <?php endforeach  ?>
            </tbody>
        </table>
    </div>

    <?php require './templates/footer.phtml'; 
    } 
    public function showOwner($owner){
        require './templates/header.phtml' ;
    ?>
       <!--el controler me envia los dusenios que el modelo pidio a la DB-->
       <div class="container mt-5">
           <h2 class="text-center mb-4">Dueños</h2>
           <table class="table table-bordered table-striped">
               <thead class="table-header">
                   <tr>
                       <th>Nombre</th>
                       <th>Teléfono</th>
                       <th>Email</th>
                   </tr>
               </thead>
               <tbody>
                <!-- no es necesario hacer un foreach, trae un OBJETO   -->
                    <tr>
                        <td><?php echo $owner->name ?> </td>
                        <td><?php echo $owner->phone ?> </td>
                        <td><?php echo $owner->email ?> </td>
                        <td><a class="btn btn-danger" href="deteleOwner/<?php $owner->id_owner?>">Eliminar</a></td>
                    </tr>
               </tbody>
           </table>
       </div>
    <?php
        require './templates/footer.phtml'; 
    } 
    public function showError($mjsError){
        require './templates/header.phtml'; 
    ?>
        <h1>Error: <?php echo $mjsError?> </h1>
    <?php
        require './templates/footer.phtml'; 
    }
} 
?>