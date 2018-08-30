<?php
defined('BASEPATH') OR exit ('No direct script acces allowed');

class helloworld extends CI_Controller{

	public function index(){
		$this->load->model('mymodel');
		$data = $this->mymodel->getMahasiswa('data_mahasiswa');
		$data = array('data' => $data);
		$this->load->view('data_mahasiswa', $data);
	}

	public function add_data()
	{
		$this->load->view('form_add');
	}

	public function insert()
	{
		$this->load->model('mymodel');
		$data = array(
			'no_induk' => $this->input->post('ni'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat')
			);
		$data = $this->mymodel->Insert('data_mahasiswa', $data);
		redirect(base_url(),'refresh');
	}
 	public function Edit_data()
	{
		$this->load->model('mymodel');
		if (isset($_POST['submit']))
		{
			$nim = $this->input->post('nim');
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');

			$data = array(
				'nama' => $nama,
				'alamat' => $alamat,
				);
			$where = array(
				'no_induk' => $nim
				);
			$this->mymodel->update('data_mahasiswa', $where ,$data);

			redirect('index.php/helloworld');
			}else
			{
				$id = $this->uri->segment(3);
				$data = array(
					'title' => 'Data Mahasiswa',
					'mhs' => $this->db->get_where('data_mahasiswa',array('no_induk' => $id))->row_array()
				);
				$this->load->view('form_edit', $data); 
			}
		}

		public function Delete_data()
		{
		$this->load->model('mymodel');
			$nim = $this->uri->segment(3);

			$where = array(
				'no_induk' => $nim
			);
			$this->mymodel->delete('data_mahasiswa', $where);
			redirect('index.php/helloworld');
		}
	}
?>
