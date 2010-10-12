<?php $this->set('TITLE', 'default Doctrine'); ?>

    <h1>Doctrine</h1>
    
    <?= $this->partial('flash') ?>

    <h2>Deploy</h2>
    <ul>
        <li><a class="confirm" href="/doctrine/default/generate-tables/">Generate Tables</a></li>
        <li><a class="confirm" href="/doctrine/default/load-data/">Load Data</a></li>
    </ul>
    
    <h2>Load</h2>
    <ul>
        <li><a class="confirm" href="/doctrine/default/load-data/">Load Data</a></li>
    </ul>

    <h2>Dump</h2>
    <ul>
        <li><a class="confirm" href="/doctrine/default/dump-data/">Dump Data</a></li>
    </ul>
    
    <h2>Generate</h2>
    <ul>
        <li><a class="confirm" href="/doctrine/default/generate-schema/">Generate Schema</a></li>
        <li><a class="confirm" href="/doctrine/default/generate-models/">Generate Models</a></li>
        <li><a class="confirm" href="/doctrine/default/generate-tables/">Generate Tables</a></li>
    </ul>
  
    <script type="text/javascript">
        $(function() {
			$('.confirm').click(function() {
				if (confirm('Etes-vous sûr de voulior lancer ce script ?')) {
					return true;
				}
				return false;
			});
        });
    </script>