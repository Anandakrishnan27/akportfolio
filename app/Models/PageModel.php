<?php

namespace App\Models;

use CodeIgniter\Model;

class PageModel extends Model
{
    protected $table = 'tbl_contact';
    protected $primaryKey = 'contact_id';

    protected $allowedFields = ['contact_name', 'contact_phone', 'contact_email', 'contact_subject', 'contact_message', 'contact_created_at'];

}
?>