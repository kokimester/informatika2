<?php 
    include 'header.php';
    include 'menu.php';
?>

<?php 
    $self['name'] = 'Minta Janos';
    $self['elo'] = 1500;
    $self['list'] = 'https://raithos.github.io/?f=Rebel%20Alliance&d=v8ZsZ200Z451XWW101WY463XWW99WY43XWW77W52W314WWW&sn=Lando%27s%20Hoes&obs=';

    $opponent['name'] = 'Luke Skywalker';
    $opponent['elo'] = 1500;

    $winner = $self;

    $points_change = 15;


?>

  <div class="container align-self-center">
    <div class="row text-black-50">
        <div class="col-12">
             <table class="table table-striped table-bordered bg-light">
                 <tr>
                     <th>
                         Player 1
                     </th>
                     <th>
                        Elo
                     </th>
                     <th>
                         List
                     </th>
                     <th>
                     VS.
                     </th>
                     <th>
                       Player 2
                     </th>
                     <th>
                         Elo
                     </th>
                     <th>
                         List
                     </th>
                 </tr>
                 <!-- FOREACH IDE -->
                 <tr>
                 
                     <td>
                      <?php echo $self['name'];?>
                     </td>
                     <td>
                      <?php echo $self['elo'].(($winner === $self ) ? " +".$points_change : " -".$points_change);?>
                     </td>
                     <td>
                      <a href=<?php echo $self['list'];?>>Link</a>
                     </td>
                     <td>
                        &nbsp;
                     </td>
                     <td>
                      <?php echo $opponent['name'];?>
                     </td>
                     <td>
                     <?php echo $opponent['elo'].(($winner === $opponent ) ? " +".$points_change : " -".$points_change);?>
                     </td>
                     <td>
                     <?php if(isset($opponent['list'])){

                     echo `<a href={$opponent['list']}> Link </a>`;}
                     else{
                        echo '<a>List not found</a>';
                     }
                     ?>
                     </td>
                 </tr>
             </table>
        </div>
    </div>
</div>

  
  <div class="container">
    <div class="row text-center">
      <div class="col-12">
        <form><a class="btn btn-lg btn-success" href="/hirdetes/new" role="button"><i class="fas fa-plus-circle"></i> Hirdetés hozzáadása</a></form>
      </div>
    </div>
  </div>

  <%- include('footer') -%>