JContentHider
=============
<h3>Capability :</h3>
<p>This is Joomla Content Plugin which will helps you to hide content of Joomla articles on the basis of user group.</p>

<h3>Why To Use :</h3>
<p>If you have an article on your Joomla site and you want some part of it to be visible to Guest and not visible to users of other groups or vice versa.</p>

<h3>How To Use :</h3>
<p>For using this Just download <strong>jcontenthider.zip</strong> and install it from extension manager of your Joomla site.</p>
<p>Now go to Plugin Manager and enable it.</p>

<h3>Main thing to do is:</h3>

<p>Open the article whose text you want to hide or show to particular group id(s), now you have to pack all the text you want to hide/show in tags like </p>

   <code>{jcontenthider g_id=group_id(s) ACTION}
	    	/* Your Text Resides Here. */
	  {/jcontenthider}</code>

   <p><strong>G_id   :</strong> id(s) of Joomla User Group(s).</p>
	 <p><strong>ACTION :</strong> HIDE/SHOW, action will performed on the enclosed text.</p>

   <code>{jcontenthider g_id=8 SHOW}
		/* Your Text Resides Here. */
	 {/jcontenthider}</code>
	 <p>If you are doing this then the enclosed text only visible to the uers of Joomla Gruop whose id is 8.</p>
	 
	 
<p>If you are facing any issue feel free to contact me on mail <a href="mailto:jkhatri6@gmail.com">Jitendra Khatri</a></p>
