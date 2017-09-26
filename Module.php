<?php
namespace asinfotrack\yii2\wiki;

use yii\helpers\Inflector;

/**
 * Main module class of the wiki.
 *
 * @author Pascal Mueller, AS infotrack AG
 * @link http://www.asinfotrack.ch
 * @license MIT
 */
class Module extends \yii\base\Module implements \yii\base\BootstrapInterface
{

	/**
	 * @var string the default namespace for this modules controllers
	 */
	public $controllerNamespace = 'asinfotrack\yii2\wiki\controllers';

	/**
	 * @var string the default route to use when not specified
	 */
	public $defaultRoute = 'content';

	/**
	 * @var string name of the article used as the index of the wiki
	 */
	public $indexArticleId = 'index';

	/**
	 * @var string the model class to use for the wiki articles
	 */
	public $modelClass = 'asinfotrack\yii2\wiki\models\Wiki';

	/**
	 * @var string the class used for searching
	 */
	public $searchModelClass = 'asinfotrack\yii2\wiki\models\WikiSearch';

	/**
	 * @var string the query class
	 */
	public $queryClass = 'asinfotrack\yii2\wiki\models\WikiQuery';

	/**
	 * @var string regex used to validate article ids
	 */
	public $articleIdRegex = '/^[a-z0-9-]+$/';

	/**
	 * @var string Optional custom message for teh validator validating with the regex
	 * set in `$articleIdRegex`.
	 *
	 * @see http://www.yiiframework.com/doc-2.0/yii-validators-validator.html#$message-detail
	 */
	public $invalidArticleIdMessage;

	/**
	 * @var \Closure Optional callback which creates an article id from a string. If
	 * not set, `Inflector::slug()` will be used.
	 *
	 * The callback needs to have the signature `function ($string)` and return a string
	 * used as an id. Make sure the returned string corresponds with `$articleIdRegex`.
	 */
	public $createArticleIdCallback;

	/**
	 * @var \Closure Optional callback to process the content of an article. If set
	 * this callback will come into effect when an articles content is requested via
	 *
	 * The callback needs to have the signature `function ($content)`, where `$content`
	 * will be the articles raw content. The callback must return a string which will
	 * be used for outputting the content.
	 *
	 * Use this callback if you want your content to be formatted in markdown or modified
	 * otherwise.
	 */
	public $processContentCallback;

	/**
	 * @var array the views used to display the content.
	 * The keys are the actions of the `ContentController` while the values
	 * are the corresponding views. By changing the values to another view
	 * you can use your own.
	 *
	 * Example: 'admin'=>'//my-wiki-views/admin'
	 */
	public $viewMap = [
		'admin'=>'admin',
		'view'=>'view',
		'create'=>'create',
		'update'=>'update',
	];

	/**
	 * @var bool if enabled, this will add the default url rules defined in `defaultUrlRules`
	 * of this class. You can of course also do this via the regular config of your
	 * url manager.
	 */
	public $addDefaultUrlRules = false;

	public $layout;

	/**
	 * @var array optional set of default url rules which will be added to the applications
	 * url rules. If enabled, the module name will be omitted by default. The wiki is then
	 * accessible via `wiki/view/my-article` instead of `wiki/content/view/my-srticle`
	 */
	public $defaultUrlRules = [
		'<module:(wiki)>'=>'<module>/content/index',
		'<module:(wiki)>/<action:[\w-]+>/<id:[\w\d-]+>'=>'<module>/content/<action>',
		'<module:(wiki)>/<action:[\w-]+>'=>'<module>/content/<action>',
	];

    /**
     * roles list, who can edit
     * @var bool|array
     */
	public $rolesCanEdit = false;

	/**
     * roles list, who can view
     *  ['?','@'] - guest and authorised users
     * @var bool|array
     */
	public $rolesCanView = false;

	/**
	 * @inheritdoc
	 */
	public function bootstrap($app)
	{
		//add default url rules if desired
		if ($this->addDefaultUrlRules && !empty($this->defaultUrlRules)) {
			$app->urlManager->addRules($this->defaultUrlRules, false);
		}
	}

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
	}

	/**
	 * Creates an article id from a string
	 *
	 * @param string $string the raw string to create an article id from
	 * @return string the corrected string ready to use as an article id
	 */
	public function createArticleId($string)
	{
		if ($this->createArticleIdCallback !== null && $this->createArticleIdCallback instanceof \Closure) {
			return call_user_func($this->createArticleIdCallback, $string);
		} else {
			return Inflector::slug($string);
		}
	}

	/**
	 * Checks whether or not an article id is valid
	 *
	 * @param string $id the id to check
	 * @return bool true if the id is valid
	 */
	public function isValidArticleId($id)
	{
		return preg_match($this->articleIdRegex, $id) === 1;
	}

	/**
	 * Processes the content of an article for output. By default the content gets returned in raw format.
	 * If `processContentCallback` is set, it will be called instead.
	 *
	 * @param string $content the raw content from the article as saved in the db
	 * @return string the processed content ready for output
	 */
	public function processContent($content)
	{
		if ($this->processContentCallback !== null && $this->processContentCallback instanceof \Closure) {
			return call_user_func($this->processContentCallback, $content);
		} else {
			return $content;
		}
	}

}
