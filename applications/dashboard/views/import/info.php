<?php if (!defined('APPLICATION')) exit();
$this->AddSideMenu();
?>
<h2><?php echo T('Import'); ?></h2>
<?php
$CurrentStep = GetValue('CurrentStep', $this->Data, 0);
$Complete = FALSE;
if($CurrentStep < 1) {
	// The import hasn't started yet.
	echo '<div class="Info">',
		T('Garden.Import.Info', 'You\'ve successfully uploaded an import file.
Please review the information below and click <b>Start Import</b> to begin the import.'),
		  '</div>';
} else {
   $Steps = GetValue('Steps', $this->Data, array());
   if(count($Steps) > 0 && !array_key_exists($CurrentStep, $Steps)) {
      // The import is complete.
      $Complete = TRUE;
      // The import is complete.
      echo '<div class="Info">',
         T('Garden.Import.Complete.Description', 'You have successfully completed an import.
   Click <b>Finished</b> when you are ready.'),
         '</div>';
   } else {
      // The import is in process.
      echo '<div class="Info">',
         T('Garden.Import.Continue.Description', 'It appears as though you are in the middle of an import.
   Please choose one of the following options.'),
         '</div>';
   }
}

include($this->FetchViewLocation('stats', 'import', 'dashboard'));

if($CurrentStep < 1)
   echo Anchor(T('Start Import'), 'dashboard/import/go', 'Button'),
   ' ',
   Anchor(T('Restart'), 'dashboard/import/restart', 'Button');
elseif(!$Complete)
   echo Anchor(T('Continue Import'), 'dashboard/import/go', 'Button'),
   ' ',
   Anchor(T('Restart'), 'dashboard/import/restart', 'Button');
else
   echo Anchor(T('Finished'), 'dashboard/import/restart', 'Button');

	