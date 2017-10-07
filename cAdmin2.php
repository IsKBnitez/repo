<?php
/**
 *
 */
class CAdmin2 extends CI_Controller
{

 function __construct()
  {
    parent::__construct();
    $this->load->model("mAdmin2");
  }

  public function Index()
  {
    $this->load->view('Marcos/Encabezado');
    $this->load->view('Marcos/Menu');
    $this->load->view('Frontend/vAdmin2');
    $this->load->view('Marcos/Piepagina');
  }

  public function consultaruuss()
  {
    if ($this->input->is_ajax_request()) {
      $datos = $this->mAdmin2->consultaruuss();
      echo json_encode($datos);
    }
    else {
      show_404();
    }
  }

  public function consultar()
  {
    if ($this->input->is_ajax_request()) {
      $buscar=$this->input->post("buscar");
      $datos = $this->mAdmin2->consultar($buscar);
      echo json_encode($datos);
    }
    else {
      show_404();
    }
  }

  public function guardar()
  {

    $nombre= $this->input->post("nombre");
    $apellido=$this->input->post("apellido");
    $sexo= $_POST["sexo"];
    $edad=$this->input->post("edad");
    $tel = $this->input->post("tel");
    $email=$this->input->post("ema");
    $usuario = $this->mAdmin2->valordelid($this->input->post("uss"));

    $config =
    [
      "upload_path" => "./img/admin",
      'allowed_types' => "png|jpg"
    ];
    $this->load->library("upload",$config);

    if($this->upload->do_upload('fotos'))
    {
      $datos1 = array(
        "upload_data" => $this->upload->data()

      );
      $datos=array(
        'nombre' =>$nombre,
        'apellido' =>$apellido,
        'foto' => $datos1["upload_data"]["file_name"],
        'sexo' =>$sexo,
        'edad' =>$edad,
        'numero_tel' =>$tel,
        'email_admin' =>$email,
        'id_us' =>$usuario);
      if($this->mAdmin2->guardar($datos)==true){
      echo "Registros Guardados";
    }
      else{
    echo $usuario;

    }
    }
    else {
      echo $this->upload->display_errors();
    }


}

public function modificar()
{
  $id = $this->input->post("id2");
  $nombre= $this->input->post("nombre2");
  $apellido=$this->input->post("apellido2");
  $sexo= $_POST["sexo2"];
  $foto= $this->input->post("fotoante");
  $edad=$this->input->post("edad2");
  $tel = $this->input->post("tel2");
  $email=$this->input->post("ema2");
  $usuario = $this->mAdmin2->valordelid($this->input->post("uss2"));

  $config =
  [
    "upload_path" => "./img/admin",
    'allowed_types' => "png|jpg"
  ];
  $this->load->library("upload",$config);

  if($this->upload->do_upload('fotos2'))
  {
    $datos1 = array(
      "upload_data" => $this->upload->data()
    );
    $datos=array(
      'nombre' =>$nombre,
      'apellido' =>$apellido,
      'foto' => $datos1["upload_data"]["file_name"],
      'sexo' =>$sexo,
      'edad' =>$edad,
      'numero_tel' =>$tel,
      'email_admin' =>$email,
      'id_us' =>$usuario);
    if($this->mAdmin2->modificar($id,$datos)==true){
    echo "Registros Actualizado";
    }
    else{
      echo "Error al Actualizar";
    }
  }
  else {
    $datos=array(
      'nombre' =>$nombre,
      'apellido' =>$apellido,
      'foto' => $foto,
      'sexo' =>$sexo,
      'edad' =>$edad,
      'numero_tel' =>$tel,
      'email_admin' =>$email,
      'id_us' =>$usuario);
    if($this->mAdmin2->modificar($id,$datos)==true){
    echo "Registros Actualizado";
    }
    else{
      echo "Error al Actualizar";
    }

  }

}

public function eliminar(){
  if ($this->input->is_ajax_request()) {
    $id = $this->input->post("idajax");
    $registro = $this->mAdmin2->Nimagen($id);
    unlink("./img/admin/".$registro);
    if ($this->mAdmin2->eliminar($id)==true) {
      echo "Registro Eliminado";
    }
    else {
      echo "Error al eliminar el registro";
    }

  }

}



}



 ?>
