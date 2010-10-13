<?php

/**
 * Spanish (Mexico) language pack
 * @package Socializer
 * @subpackage i18n
 */

i18n::include_locale_file('cms', 'en_US');

global $lang;

if(array_key_exists('es_MX', $lang) && is_array($lang['es_MX'])) {
	$lang['es_MX'] = array_merge($lang['en_US'], $lang['es_MX']);
} else {
	$lang['es_MX'] = $lang['en_US'];
}

$lang['es_MX']['Socializer']['ADMININSTRUCTIONS'] = <<<INSTRUCTIONS
Agrege nuevos links de redes sociales si no tiene ninguno de click en "Nuevo Socializer" para comenzar
INSTRUCTIONS;

$lang['es_MX']['Socializer']['MODULENAME'] = 'Socializer';
$lang['es_MX']['Socializer']['ROOT'] = 'Socializer';
$lang['es_MX']['Socializer']['BTNNEW'] = 'Nuevo Socializador';

$lang['es_MX']['Socializer']['SERVICE'] = 'Servicio';
$lang['es_MX']['Socializer']['NAME'] = 'Nombre';
$lang['es_MX']['Socializer']['URL'] = 'Url';
$lang['es_MX']['Socializer']['TITLE'] = 'Titulo';
$lang['es_MX']['Socializer']['SAVE'] = 'Salvar';
$lang['es_MX']['Socializer']['UPDATE'] = 'Actualizar';
$lang['es_MX']['Socializer']['DELETE'] = 'Borrar';

$lang['es_MX']['Socializer']['SAVENEWITEM'] = 'Nuevo Socializador Salvado';
$lang['es_MX']['Socializer']['UPDATEITEM'] = 'Socializador Actualizado';
$lang['es_MX']['Socializer']['DELETEITEM'] = 'Socializador Eliminado';
$lang['es_MX']['Socializer']['FAILNEWITEM'] = 'Error al salvar/actualizar/eliminar socializador';

$lang['es_MX']['Socializer']['SAVESTATUS'] = 'Salvado (Nuevo)';
$lang['es_MX']['Socializer']['UPDATESTATUS'] = 'Salvado (Actializado)';
$lang['es_MX']['Socializer']['DELTESTATUS'] = 'Salvado (Eliminado)';

$lang['es_MX']['Socializer']['INSTRUCTION'] = <<<INSTRUCTIONS
<div>
     <h5>Instrucciones:</h5>Usted puede utilizar las siguientes variables<br/>
     <strong>&#36;Page_Title</strong> : Toma el titulo de la pagina,<br/>
     <strong>&#36;Page_Url</strong> : Regresa la URL de la pagina actual para compartir<br/>
     <strong>Ejemplo de uso:</strong><br/>
     http://www.google.com/bookmarks/mark?op=edit&output=popup&bkmk=&#36;Page_Url&title=&#36;Page_Title
     <br/> <br/>
</div>
 
INSTRUCTIONS;

$lang['es_MX']['SocializerDecorator']['SHOWICONS'] = '¿Desea mostrar los iconos de redes sociales?';
$lang['es_MX']['SocializerDecorator']['INVITEFRIEND'] = 'Invitar a un amigo';
$lang['es_MX']['SocializerDecorator']['PRINT'] = 'Imprimir';

$lang['es_MX']['Send2Friend']['FROM'] = 'De';
$lang['es_MX']['Send2Friend']['TO'] = 'Para';
$lang['es_MX']['Send2Friend']['SEND'] = 'Enviar';
$lang['es_MX']['Send2Friend']['SENDING'] = "Enviando...";
$lang['es_MX']['Send2Friend']['INVITINGTEMPLATE'] = <<<TEMPLATE
<div>
<p> Un Amigo tuyo considera de deberias o que te podria interesar la siguiente pagina: %s </p>
</div>
TEMPLATE;
?>
