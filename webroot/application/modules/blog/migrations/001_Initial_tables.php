<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Instalación de las tablas iniciales:
 *	Publicaciones
 */

class Migration_Initial_tables extends Migration {
  /**
	 * @var array Permisos por Defecto
	 */
  private $permissionValues = array(
    array('name' => 'Bonfire.Blog.View', 'description' => 'Mostrar el menú del blog.', 'status' => 'active'),
    array('name' => 'Bonfire.Blog.Delete', 'description' => 'Eliminar entradas del blog', 'status' => 'active'),
  );

  /**
	 * @var array Roles por Defecto
	 */
  private $permittedRoles = array(
    'Administrator',
  );

  /**
   * Configuración de la tabla para la migracion.
   * @type array
   */
  private $tables = array(
    'Publicaciones' => array(
      'primaryKey' => 'publ_id',
      'fields' => array(
        'publ_id' => array(
          'type'           => 'INT',
          'constraint'     => 10,
          'unsigned'       => true,
          'auto_increment' => true,
          'null'           => false,
        ),
        'titulo' => array(
          'type'       => 'VARCHAR',
          'constraint' => 255,
          'null'       => false,
        ),
        'subtitulo' => array(
          'type'       => 'VARCHAR',
          'constraint' => 255,
          'null'       => false,
        ),
        'contenido' => array(
          'type'       => 'TEXT',
          'null'       => false,
        ),
        'autor' => array(
          'type'       => 'VARCHAR',
          'constraint' => 15,
          'null'       => false,
        ),
        'created_on' => array(
          'type'       => 'DATETIME',
          'null'       => false,
        ),
        'modified_on' => array(
          'type'       => 'DATETIME',
          'null'       => true,
        ),
        'deleted' => array(
          'type'       => 'TINYINT',
          'constraint' => 1,
          'null'       => false,
          'default'    => 0,
        ),
      ),
    ),
  );

  /**
   * Instalando la tabla
   *
   * @return void
   */
  public function up() {
    // Se utiliza la conexión a SQL Server para la(s) tabla(s).
    $this->db_evpiu = $this->load->database('EVPIU', TRUE);
    $this->evpiu_forge = $this->load->dbforge($this->db_evpiu, TRUE);

    // Instalación de la(s) tabla(s) en SQL Server.
    foreach ($this->tables as $tableName => $tableDef) {
      $this->evpiu_forge->add_field($tableDef['fields']);
      $this->evpiu_forge->add_key($tableDef['primaryKey'], TRUE);
      $this->evpiu_forge->create_table($tableName);
    }

    // Se alterna la conexión hacia MariaDB para manejar la gestión de CI Bonfire.
    // Creando los Permisos.
    $this->load->model('permissions/permission_model');
    $permissionNames = array();
    foreach ($this->permissionValues as $permissionValue) {
      $this->permission_model->insert($permissionValue);
      $permissionNames[] = $permissionValue['name'];
    }

    // Asignando los permisos a los roles permitidos.
    $this->load->model('role_permission_model');
    foreach ($this->permittedRoles as $permittedRole) {
      foreach ($permissionNames as $permissionName) {
        $this->role_permission_model->assign_to_role($permittedRole, $permissionName);
      }
    }
  }

  /**
   * Eliminando la tabla
   *
   * @return void
   */
  public function down() {
    // Se utiliza la conexión a SQL Server para la(s) tabla(s).
    $this->db_evpiu = $this->load->database('EVPIU', TRUE);
    $this->evpiu_forge = $this->load->dbforge($this->db_evpiu, TRUE);

    // Eliminación de la(s) tabla(s) en SQL Server.
    foreach ($this->tables as $tableName => $tableDef) {
      $this->evpiu_forge->drop_table($tableName);
    }

    // Eliminando los permisos.
    $this->load->model('roles/role_permission_model');
    $this->load->model('permissions/permission_model');

    $permissionKey = $this->permission_model->get_key();
    foreach ($this->permissionValues as $permissionValue) {
      $permission = $this->permission_model->select($permissionKey)
                                           ->find_by('name', $permissionValue['name']);
      if ($permission) {
        // permission_model's delete method calls the role_permission_model's
        // delete_for_permission method.
        $this->permission_model->delete($permission->{$permissionKey});
      }
    }
  }
}
