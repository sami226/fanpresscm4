<?php

/**
 * FanPress CM Category List Model
 * @author Stefan Seehafer aka imagine <fanpress@nobody-knows.org>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */

namespace fpcm\model\categories;

/**
 * Kategorie-Listen-Objekt
 * 
 * @package fpcm\model\categories
 * @author Stefan Seehafer <sea75300@yahoo.de>
 */
class categoryList extends \fpcm\model\abstracts\tablelist {

    /**
     * Konstruktor
     */
    public function __construct()
    {
        $this->table = \fpcm\classes\database::tableCategories;
        parent::__construct();
    }

    /**
     * Liefert ein array aller Kategorien
     * @return array
     */
    public function getCategoriesAll()
    {
        $list = $this->dbcon->selectFetch((new \fpcm\model\dbal\selectParams($this->table))->setFetchAll(true));

        $res = [];

        foreach ($list as $listItem) {
            $object = new category();
            if ($object->createFromDbObject($listItem)) {
                $res[$object->getId()] = $object;
            }
        }

        return $res;
    }

    /**
     * Liefert ein array aller Kategorien
     * @return array
     * @since FPCM 3.3
     */
    public function getCategoriesNameListAll()
    {
        $categories = $this->dbcon->selectFetch((new \fpcm\model\dbal\selectParams($this->table))->setItem('id, name')->setFetchAll(true));

        $res = [];
        foreach ($categories as $category) {
            $res[$category->name] = $category->id;
        }

        return $res;
    }

    /**
     * Liefert ein array aller Kategorien, auf welche die angegebene Gruppe zugreifen darf
     * @param int $groupId
     * @return array
     */
    public function getCategoriesByGroup($groupId)
    {
        $where = "(groups = ? OR groups " . $this->dbcon->dbLike() . " ? OR groups " . $this->dbcon->dbLike() . " ? OR groups " . $this->dbcon->dbLike() . " ?) ";
        $where .= $this->dbcon->orderBy(['id ASC']);

        $valueParams = [];
        $valueParams[] = "{$groupId}";
        $valueParams[] = "%;{$groupId};%";
        $valueParams[] = "{$groupId};%";
        $valueParams[] = "%;{$groupId}";

        $obj = (new \fpcm\model\dbal\selectParams($this->table))->setWhere($where)->setParams($valueParams)->setFetchAll(true);

        $res = [];

        foreach ($this->dbcon->selectFetch($obj) as $listItem) {
            $object = new category();
            if ($object->createFromDbObject($listItem)) {
                $res[$object->getId()] = $object;
            }
        }

        return $res;
    }

    /**
     * Liefert ein array aller Kategorien, auf die der aktuelle Benutzer zugreifen darf
     * @return array
     */
    public function getCategoriesCurrentUser()
    {
        $session = \fpcm\classes\loader::getObject('\fpcm\model\system\session');
        if (!is_object($session) || !$session->exists()) {
            return [];
        }

        return $this->getCategoriesByGroup( $session->getCurrentUser()->getRoll() );
    }

    /**
     * Liefert ein array aller Kategorie-Namen
     * @return array
     */
    public function getCategoriesNameListCurrent()
    {
        $categories = $this->getCategoriesCurrentUser();

        $res = [];

        foreach ($categories as $category) {
            $res[$category->getName()] = $category->getId();
        }

        return $res;
    }

    /**
     * Prüft ob Kategorie existiert
     * @param string $name
     * @return bool
     */
    public function categorieExists($name)
    {
        $result = $this->dbcon->count($this->table, "id", "name " . $this->dbcon->dbLike() . " ?", array($name));
        return ($result > 0) ? true : false;
    }

    /**
     * Assign category data for frontend output
     * @param \fpcm\model\articles\article $article
     * @return array
     */
    public function assignPublic(\fpcm\model\articles\article $article)
    {
        if (!count($this->data)) {
            $this->data = $this->getCategoriesAll();
        }

        $result = [];
        foreach ($article->getCategories() as $categoryId) {

            $category = isset($this->data[$categoryId]) ? $this->data[$categoryId] : false;
            if (!$category) {
                continue;
            }

            $result['<span class="fpcm-pub-category-text">' . $category->getName() . '</span>'] = ($category->getIconPath() ? $category->getCategoryImage() : '');
        }
        
        return $result;
    }

}
