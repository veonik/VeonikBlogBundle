<?php

/*
 * Copyright (c) Tyler Sommer
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Veonik\Bundle\BlogBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class TagRepository extends EntityRepository
{
    /**
     * Gets sidebar data
     *
     * @return array
     */
    public function getSidebarData()
    {
        if ($this->_entityName === 'Veonik\Bundle\BlogBundle\Entity\Category') {
            $join = 'JOIN posts_categories pt ON pt.category_id = t.id ';
        } else {
            $join = 'JOIN posts_tags pt ON pt.tag_id = t.id ';
        }

        $cmp = $this->_em->getConnection()->getDatabasePlatform()->convertBooleansToDatabaseValue(true);
        $stmt = $this->_em->getConnection()->executeQuery(
            "SELECT t.id FROM tags t 
                  {$join}
                  JOIN posts p ON pt.post_id = p.id 
                WHERE p.active = ${cmp}
                  AND t.active = ${cmp}
                GROUP BY t.id
                ORDER BY COUNT(p.id) DESC
                LIMIT 10"
        );
        $results = $stmt->fetchAll(\PDO::FETCH_COLUMN);
        
        return $this->createQueryBuilder('t')
            ->join('VeonikBlogBundle:AbstractPost', 'p')
            ->where('t.id IN (:ids)')
            ->setParameter('ids', $results)
            ->getQuery()
            ->useResultCache(true, 3600, 'sidebar_tags' . $this->_entityName)
            ->getResult();
    }
}
