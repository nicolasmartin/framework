<?php
	$this->set('TITLE', 		'Titre de la page');
	$this->set('DESCRIPTION',	'Description de la page');
?>
    <div id="content">

    	<div id="main" class="col3-4 first">
            <ul class="breadcrumbs">
                <li><a href="#">Home</a> / </li>
                <li><a href="#">Link 1</a> / </li>
                <li><a href="#">Link 2</a> / </li>
                <li>Link 3</li>
            </ul>
        
            <h1>Title of the page</h1>

			<p>Daddy Bender, we're hungry. I could if you hadn't turned on the light and shut off my stereo. Oh, how I wish I could believe or understand that! There's only one reasonable course of action now: kill Flexo! Spare me your space age technobabble, Attila the Hun! And yet you haven't said what I told you to say! How can any of us trust you?</p>

            <h5>Tables &amp; lists</h5>
                
            <div class="toolbar">
                <ul>
                    <li><a class="sprite prefix edit" href="#">Ajouter</a></li>
                    <li><a class="sprite prefix edit" href="#">Ordonner</a></li>
                </ul>
            </div>
 
            <form action="" method="post">
            <table>
                <colgroup>
                    <col width="40" />
                    <col />
                    <col />
                    <col />
                    <col width="80" />
                </colgroup>
                <thead>
                    <tr>
                        <th><input type="checkbox" /></th>
                        <th class="order-asc"><a href="#">Column1</a></th>
                        <th class="order-desc"><a href="#">Column2</a></th>
                        <th><a href="#">Column3</a></th>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="2" class="batch-actions">
                            <select>
                                <option>&#8212; Actions &#8212;</option>
                                <option>Editer</option>
                                <option>Supprimer</option>
                            </select>
                            <input class="button" type="submit" value="Appliquer" />
                        </td>
                        <td colspan="100" class="pagination" valign="right">
                            <span class="page-first">&laquo; Début</span>
                            <span class="page-prev">Précédent</span>
                            <span class="page-current">1</span> 
                            <a href="#">2</a> 
                            <a href="#">3</a> 
                            <a href="#">4</a> 
                            <a class="page-next" href="#">Suivant</a> 
                            <a class="page-last" href="#">Fin &raquo;</a>
    
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <tr class="odd">
                        <td><input type="checkbox" /></td>
                        <th>Column1</th>
                        <td>Column2</td>
                        <td>Column3</td>
                        <td>
                            <ul class="actions">
                                <li><a class="sprite icon edit" href="#">Edit</a></li>
                                <li><a class="sprite icon delete" href="#">Remove</a></li>
                            </ul>					
                        </td>
                    </tr>
                    <tr class="even">
                        <td><input type="checkbox" /></td>
                        <th>Column1</th>
                        <td>Column2</td>
                        <td>Column3</td>
                        <td>
                            <ul class="actions">
                                <li><a class="sprite icon edit" href="#">Edit</a></li>
                                <li><a class="sprite icon delete" href="#">Remove</a></li>
                            </ul>					
                        </td>
                    </tr>
                    <tr class="odd">
                        <td><input type="checkbox" /></td>
                        <th>Column1</th>
                        <td>Column2</td>
                        <td>Column3</td>
                        <td>
                            <ul class="actions">
                                <li><a class="sprite icon edit" href="#">Edit</a></li>
                                <li><a class="sprite icon delete" href="#">Remove</a></li>
                            </ul>					
                        </td>
                    </tr>	
                    <tr class="even">
                        <td><input type="checkbox" /></td>
                        <th>Column1</th>
                        <td>Column2</td>
                        <td>Column3</td>
                        <td>
                            <ul class="actions">
                                <li><a class="sprite icon edit" href="#">Edit</a></li>
                                <li><a class="sprite icon delete" href="#">Remove</a></li>
                            </ul>					
                        </td>
                    </tr>	
                </tbody>		
            </table>
            </form>

            <h5>Form</h5>
            <div class="message error">
                You people wonder why I'm still single?
            </div>
    
            <div class="message success">
                Shut up and take my money! And until then, I can never die?
            </div>			
    
            <div class="message info">
                Say it in Russian! Isn't it true that you have been paid for your testimony?
            </div>
            
            <form action="#" method="post">
            
                <fieldset>
                    <legend>Legend</legend>
            
                    <div class="odd">
                        <label>Label</label>
                        <input class="large" type="text" value="I had more, but you go ahead." />		
                        <small class="hint">Field hint or description</small>		
                    </div>
                    
                    <div class="even">
                        <label>Label</label>
                        <input class="medium" type="text" value="Anyone who laughs is a communist!" />	
                        <small class="hint">Field hint or description</small>					
                    </div>
                
                    <div class="odd has-error">
                        <label>Label</label>
                        <input class="small error" type="text" value="You guys go on without me! I'm going to go..." />	
                        <small class="hint">Field hint or description</small>	
                        <ul class="errors">
                            <li>This field is required</li>
                            <li>This field is not valid</li>
                        </ul>			
                    </div>	
        
                    <div class="even">
                        <label>Label</label>
                        <select class="small">	
                            <option selected="selected">Bender</option>
                            <option>Fry</option>
                            <option>Leela</option>
                            <option>Conrad</option>
                        </select>
                        <small class="hint">Field hint or description</small>					
                    </div>
                
                    <div>
                        <label>Message</label>
                        <textarea cols="80" rows="10">Bender, being God isn't easy. </textarea>			
                    </div>
        
                    <div>
                        <label>Choice</label>
                        <input type="checkbox" checked="checked" /> Choice 1
                        <input type="checkbox" /> Choice 2
                        <input type="checkbox" /> Choice 3
                        <input type="checkbox" /> Choice 4
                    </div>
                    
                    <div>
                        <label>Choice</label>
                        <input type="radio" checked="checked" /> Choice 1
                        <input type="radio" /> Choice 2
                        <input type="radio" /> Choice 3
                        <input type="radio" /> Choice 4		
                    </div>
                    
                    <div>
                        <input class="button" type="submit" value="Envoyer" /> or <a href="#" class="cancel">Cancel</a>                    </div>
                </fieldset>
            </form>
            
            <a href="#" class="sprite lock icon right">Edit</a> 
			<a href="#" class="sprite lock prefix right">Edit</a>
            
            <a href="#" class="sprite download icon right">Edit</a> 
			<a href="#" class="sprite download prefix right">Edit</a>
            
            <a href="#" class="sprite home icon right">Edit</a> 
			<a href="#" class="sprite home prefix right">Edit</a>
            
            <a href="#" class="sprite user icon right">Edit</a> 
			<a href="#" class="sprite user prefix right">Edit</a>
            
            <a href="#" class="sprite email icon right">Edit</a> 
			<a href="#" class="sprite email prefix right">Edit</a>
            
            <br />
            
            <a href="#" class="sprite success icon right">Edit</a> 
			<a href="#" class="sprite success prefix right">Edit</a>
            
            <a href="#" class="sprite help icon right">Edit</a> 
			<a href="#" class="sprite help prefix right">Edit</a>    
            
            <a href="#" class="sprite info icon right">Edit</a> 
			<a href="#" class="sprite info prefix right">Edit</a>
            
            <a href="#" class="sprite warning icon right">Edit</a> 
			<a href="#" class="sprite warning prefix right">Edit</a>
            
            <a href="#" class="sprite error icon right">Edit</a> 
			<a href="#" class="sprite error prefix right">Edit</a>

            <br />
            
            <a href="#" class="sprite remove icon right">Edit</a> 
			<a href="#" class="sprite remove prefix right">Edit</a>    
            
            <a href="#" class="sprite add icon right">Edit</a> 
			<a href="#" class="sprite add prefix right">Edit</a>
            
            <a href="#" class="sprite delete icon right">Edit</a> 
			<a href="#" class="sprite delete prefix right">Edit</a>
            
            <a href="#" class="sprite edit icon right">Edit</a> 
			<a href="#" class="sprite edit prefix right">Edit</a>
        </div><!-- /main -->
    
        <div id="sidebar" class="col1-4 last">
            <ul class="menu vertical">
                <li class="current"><a href="#">Item 1</a></li>
                <li><a href="#">Item 2</a></li>
                <li><a href="#">Item 3</a></li>
                <li><a href="#">Item 4</a></li>
            </ul>
        </div><!-- /sidebar -->

    </div><!-- /content -->
