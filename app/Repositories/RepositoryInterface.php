<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of RepositoryInterface
 *
 * @author windigo
 */
interface RepositoryInterface {
    function create(array $modelData = []): Model;
    function update(array $modelData = []): Model;
    function delete(int $id): void;
}
