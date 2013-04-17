<?php
/**
 * Extended class to override the time_created
 * 
 * @property string $status      The published status of the project post (published, draft)
 * @property string $comments_on Whether commenting is allowed (Off, On)
 * @property string $excerpt     An excerpt of the project post used when displaying the post
 */
class ElggProject extends ElggObject {

	/**
	 * Set subtype to project.
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "projects";
	}

	/**
	 * Can a user edit on this project?
	 *
	 * @see ElggObject::canEdit()
	 *
	 * @param int $user_guid User guid (default is logged in user)
	 * @return bool
	 * @since 1.8.0
	 */
	public function canEdit($user_guid = 0) {
		$result = parent::canEdit($user_guid);
		if ($result == false) {
			if (is_project_member($this->getGUID(), $user_guid)){
				return TRUE;
			}else{
			return $result;
			}
		}

		
		return true;
	}

}