<?php
/**
 * Created by PhpStorm.
 * User: sotos
 * Date: 9/8/2017
 * Time: 2:26 μμ
 */
use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;

class EntrustSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $superadmin = new Role();
        $superadmin->name         = 'superadmin';
        $superadmin->display_name = 'User Super Administrator'; // optional
        $superadmin->description  = 'User is allowed to manage app.'; // optional
        $superadmin->save();

        $admin = new Role();
        $admin->name         = 'micrositeadmin';
        $admin->display_name = 'Microsite Administrator'; // optional
        $admin->description  = 'User is allowed to manage and edit Microsites'; // optional
        $admin->save();

        $member = new Role();
        $member->name         = 'ontology';
        $member->display_name = 'Ontology Engineer'; // optional
        $member->description  = 'Ontology Enginner able to define new Aggregator Mappings'; // optional
        $member->save();

        $crudUser = new Permission();
        $crudUser->name         = 'CRUD-user';
        $crudUser->display_name = 'CRUD Users'; // optional
        // Allow a user to create new users
        $crudUser->description  = 'CRUD on users'; // optional
        $crudUser->save();

        $editUser = new Permission();
        $editUser->name         = 'edit-user';
        $editUser->display_name = 'Edit User Profile'; // optional
        // Allow a user to create new users
        $editUser->description  = 'Edit own User Profile'; // optional
        $editUser->save();

        $manageOptions = new Permission();
        $manageOptions->name         = 'manage-options';
        $manageOptions->display_name = 'Manage Options'; // optional
        // Allow a user to manage the app
        $manageOptions->description  = 'Manage Options'; // optional
        $manageOptions->save();

        $manageMicrosite = new Permission();
        $manageMicrosite->name         = 'manage-microsite';
        $manageMicrosite->display_name = 'Manage Microsite'; // optional
        // Allow a user to manage microsite options
        $manageMicrosite->description  = 'Able to manage microsite options'; // optional
        $manageMicrosite->save();

        $manageOntology = new Permission();
        $manageOntology->name         = 'manage-ontology';
        $manageOntology->display_name = 'Manage Ontology'; // optional
        // Allow a user to manage microsite options
        $manageOntology->description  = 'Able to manage ontology mappings'; // optional
        $manageOntology->save();

        $crudRoles = new Permission();
        $crudRoles->name         = 'CRUD-roles';
        $crudRoles->display_name = 'Manage Roles'; // optional
        // Allow a user to manage Roles
        $crudRoles->description  = 'Able to manage Roles'; // optional
        $crudRoles->save();

        $crudPermissions = new Permission();
        $crudPermissions->name         = 'CRUD-permissions';
        $crudPermissions->display_name = 'Manage Permissions'; // optional
        // Allow a user to manage Roles
        $crudPermissions->description  = 'Able to manage Permisions'; // optional
        $crudPermissions->save();

        $superadmin->attachPermissions(array($crudUser, $editUser, $manageOptions, $manageMicrosite, $manageOntology, $crudRoles, $crudPermissions ));


        $admin->attachPermissions(array($editUser, $manageMicrosite, $manageOntology));

        $member->attachPermissions(array($editUser, $manageOntology));

    }
}