<?php
namespace phpcaniuse;
error_reporting(E_ALL);

class CanIUse
{
	private $dataFile;
	public $data;
	private $browser;
	private $agent;	//this is the caniuseName
	private $agentMap = Array('Firefox'=>'firefox','IE'=>'ie','Safari'=>'safari','Opera'=>'opera');
	private $version;
	private $statsMap = Array('n' => 0,'p' => 1, 'a x' => 2,'a' => 3,'y x' => 4,'y' = 5);
	public function __construct($browser = null,$caniusedata = null)
	{
		//load the data file first since we use it during a browser set
		if ($caniusedata) { $this->dataSet($caniusedata); }
		if ($browser) { $this->browserSet($browser); }
	}
	/**
	 *check if an array of features is supported by a browser
	 *returns the lowest level of support for the feature set
	 *expects an array, but will take a string if only a single feature is being checked
	 */
	public function check($feature)
	{
		if (!is_array($feature)) { $feature = Array($feature); }
	}
	/**
	 *returns a hash array of features, useful for figuring out what feature set you want
	 */
	public function featureList()
	{
		$out = Array();
		foreach ($this->data['data'] as $key=>$feature)
		{
			$out[$key] = $feature['title'];
		}
		return $out;
	}
	/**
	 *returns all the data for a specific feature
	 */
	public function featureGet($featureKey)
	{
		return $this->data[$featureKey];
	}
	/**
	 *returns an array of features the current browser can use
	 */
	public function browserCan()
	{
		$out = Array();
		foreach ($this->data['data'] as $key=>$feature)
		{
			$out[$key] = $feature['stats'][$this->agent][$this->version];
		}
		return $out;
	}
	/**
	 *a debugging function, returns some object props w/o all the JSON
	 */
	public function getInfo()
	{
		return Array(
			'agent'=>$this->agent,
			'Browser'=>$this->browser->Browser,
			'version'=>$this->version,
		);
	}
	/**
	 *add a browscap to caniuse mapping
	 */
	public function agentMapAdd($browscapName,$caniuseName)
	{
		$this->agentMap[$browscapName] = $caniuseName;
	}
	
	/**
	 *sets the browscap object
	 */
	public function browserSet($browser)
	{
		$this->browser = $browser;
		
		//convert the browscap agent to the caniuse agent
		if (array_key_exists($browser->Browser,$this->agentMap))
		{
			$this->agent = $this->agentMap[$browser->Browser];
		}

		//do the version too
		$this->version = floatval($this->browser->Version);
	}
	/*
	 *sets the json data - must be passed in as a string, not a decoded array
	 */
	public function dataSet($caniusedata)
	{
		$this->data = json_decode($caniusedata,true,2048,JSON_BIGINT_AS_STRING);

	}
}