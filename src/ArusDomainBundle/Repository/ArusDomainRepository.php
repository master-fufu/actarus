<?php

namespace ArusDomainBundle\Repository;

use ArusEntityTaskBundle\Entity\Search as EntityTaskSearch;

use Actarus\Utils;


/**
 * ArusDomainRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArusDomainRepository extends \Doctrine\ORM\EntityRepository
{
	public function search( $data, $offset=null, $limit=null )
	{
		$data = Utils::array2object( $data, 'ArusDomainBundle\Entity\Search' );
		$t_params = array();
		$qb = $this->_em->createQueryBuilder();

		if( $offset < 0 ) {
			$offset = null;
			$count  = true;
			$query  = $qb->select( 'count(d.id)' );
		} else {
			$count  = false;
			$query  = $qb->select( array('d') );
		}
		$query = $query->from('ArusDomainBundle:ArusDomain','d');

		if( $data )
		{
			if( ($id=$data->getId()) ) {
				if( !is_array($id) ) {
					$id = [ $id, '=' ];
				}
				$query->andWhere( 'd.id '.$id[1].' :id' );
				$t_params['id'] = $id[0];
			}
			if ($data->getProject()) {
				$query->andWhere('d.project=:project_id');
				$t_params['project_id'] = $data->getProject()->getId();
			}
			if( ($name=$data->getName()) ) {
				if( !is_array($name) ) {
					$name = [ '%'.$name.'%', 'LIKE' ];
				}
				$query->andWhere('d.name '.$name[1].' :name');
				$t_params['name'] = $name[0];
			}
			if ( !is_null($data->getSurvey()) ) {
				$survey = $data->getSurvey();
				if( !is_array($survey) ) {
					$survey = [ $survey, '=' ];
				}
				$query->andWhere('d.survey '.$survey[1].' :survey');
				$t_params['survey'] = $survey[0];
			}
			if ( !is_null($data->getStatus()) ) {
				$status = $data->getStatus();
				if( !is_array($status) ) {
					$status = [ $status, '=' ];
				}
				$query->andWhere('d.status '.$status[1].' :status');
				$t_params['status'] = $status[0];
			}
			if ($data->getMinCreatedAt()) {
				$query->andWhere('d.createdAt >= :min_created_date');
				$t_params['min_created_date'] = date( 'Y-m-d 00:00:00', Utils::dateFR2Time($data->getMinCreatedAt()) );
			}
			if ($data->getMaxCreatedAt()) {
				$query->andWhere('d.createdAt <= :max_created_date');
				$t_params['max_created_date'] = date( 'Y-m-d 23:59:59', Utils::dateFR2Time($data->getMaxCreatedAt()) );
			}
		}

		$query->setParameters( $t_params );
		$query->orderBy('d.id', 'DESC');
		if( !is_null($limit) ) {
			$query->setMaxResults( $limit );
		}
		if( !is_null($offset) ) {
			$query->setFirstResult($offset);
		}

		$t_result = $query->getQuery()->getResult();

		if( $count ) {
			return (int)$t_result[0][1];
		} else {
			return $t_result;
		}
	}


	public function getTasks( $domain )
	{
		$search = new EntityTaskSearch();
		$search->setEntityId( $domain->getEntityId() );
		$t_task = $this->_em->getRepository('ArusEntityTaskBundle:ArusEntityTask')->search( $search );

		return $t_task;
	}
}
