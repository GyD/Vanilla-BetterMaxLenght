<?php if (!defined('APPLICATION')) {
    exit();
}
/*
  Copyright 2008, 2009 Vanilla Forums Inc.
  This file is part of Garden.
  Garden is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
  Garden is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
  You should have received a copy of the GNU General Public License along with Garden.  If not, see <http://www.gnu.org/licenses/>.
  Contact Vanilla Forums Inc. at support [at] vanillaforums [dot] com
 */

$PluginInfo['DiscussionMaxLength'] = array(
  'Description' => 'Allow to have different max lenght for Discussion',
  'Version' => '1.0.0',
  'RequiredApplications' => array('Vanilla' => '2.1.8p2'),
  'RequiredTheme' => false,
  'RequiredPlugins' => false,
    //'SettingsUrl' => 'dashboard/settings/emojify',
  'HasLocale' => false,
  'Author' => "GyD",
  'AuthorEmail' => 'contact@gyd.be',
  'AuthorUrl' => 'https://github.com/GyD'
);

/**
 * Class DiscussionMaxLength
 */
class DiscussionMaxLengthPlugin extends Gdn_Plugin
{

    /**
     * @param $Sender
     */
    public function PostController_EditDiscussion_Before($Sender)
    {
        $this->setDiscussionLength();
    }

    /**
     * @param $Sender
     */
    public function PostController_Discussion_Before($Sender)
    {
        $this->setDiscussionLength();
    }

    /**
     *
     */
    private function SetDiscussionLength()
    {
        $MaxDiscussionLength = Gdn::Config('Vanilla.Discussion.MaxLength', 0);
        if (is_numeric($MaxDiscussionLength) && $MaxDiscussionLength > 0) {
            // set discussion max lenght but do not save it
            Gdn::Config()->Set('Vanilla.Comment.MaxLength', $MaxDiscussionLength, true, false);
            Gdn::Config('Vanilla.Comment.MaxLength');
        }
    }

    /*
     *  Deprecated: there is no draft specific event
    public function Base_BeforeSaveDiscussion_Handler($Sender)
    {
        $MaxCommentLength = Gdn::Config('Vanilla.Discussion.MaxLength', Gdn::Config('Vanilla.Comment.MaxLength'));
        if (is_numeric($MaxCommentLength) && $MaxCommentLength > 0) {
            $Sender->Validation->SetSchemaProperty('Body', 'Length', $MaxCommentLength);
            $Sender->Validation->ApplyRule('Body', 'Length');
        }
    }
    */
}