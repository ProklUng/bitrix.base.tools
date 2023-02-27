<?php

namespace Arrilot\BitrixMigrations\Traits;

use CGroup;
use Exception;

/**
 * Trait UserGroupTrait
 * @package Arrilot\BitrixMigrations\Traits
 *
 * @since 11.04.2021
 */
trait UserGroupTrait
{
    /**
     * @var array
     *
     * @return array
     *
     * @throws Exception
     */
    protected function userGroupCreate(array $data): array
    {
        $return = [];
        if (empty($data['STRING_ID'])) {
            throw new Exception('You must set group STRING_ID');
        }
        if ($this->userGetGroupIdByCode($data['STRING_ID'])) {
            throw new Exception('Group with STRING_ID ' . $data['STRING_ID'] . ' already exists');
        }
        $ib = new CGroup();
        $id = $ib->Add(array_merge(['ACTIVE' => 'Y'], $data));
        if ($id) {
            $return[] = "Add {$data['STRING_ID']} users group";
        } else {
            throw new Exception("Can't create {$data['STRING_ID']} users group");
        }

        return $return;
    }

    /**
     * @var string $groupName
     *
     * @return array
     *
     * @throws Exception
     */
    protected function userGroupDelete(string $groupName): array
    {
        $return = [];
        $id = $this->UserGetGroupIdByCode($groupName);
        if ($id) {
            $group = new CGroup();
            if ($group->Delete($id)) {
                $return[] = "Delete group {$groupName}";
            } else {
                throw new Exception("Can't delete group {$groupName}");
            }
        } else {
            throw new Exception("Group {$groupName} does not exist");
        }

        return $return;
    }

    /**
     * @var string $code
     *
     * @return integer|null
     *
     * @throws Exception
     */
    protected function UserGetGroupIdByCode(string $code): ?int
    {
        $by = 'c_sort';
        $order = 'desc';

        $rsGroups = CGroup::GetList($by, $order, [
            'STRING_ID' => $code,
        ]);

        if ($ob = $rsGroups->Fetch()) {
            return $ob['ID'];
        }

       return null;
    }
}
