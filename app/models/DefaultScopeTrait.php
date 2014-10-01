<?php

trait DefaultScopeTrait {

	    /**
	     * Boot the soft deleting trait for a model.
	     *
	     * @return void
	     */
	    public static function bootDefaultScopeTrait()
	    {
	        static::addGlobalScope(new DefaultScope);
	    }


	    public static function allVideos(){
	    	 return with(new static)->newQueryWithoutScope(new DefaultScope);
	    }

	}