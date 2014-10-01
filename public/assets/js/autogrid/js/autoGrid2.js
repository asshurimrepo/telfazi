/* ======================================================= 
 * Auto Grid Responsive Gallery
 * By David Blanco
 *
 * Contact: http://codecanyon.net/user/davidbo90
 *
 * Created: June 6, 2013
 *
 * Copyright (c) 2013, db. All rights reserved.
 * Released under CodeCanyon License http://codecanyon.net/
 *
 * Note: Script based in jQuery Masonry v2.1.07 made by David DeSandro http://masonry.desandro.com/ (under MIT)
 *
 * ======================================================= */


// ======================= imagesLoaded Plugin ===============================

/*!
 * imagesLoaded PACKAGED v3.0.4
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */
;
/*!
 * EventEmitter v4.2.4 - git.io/ee
 * Oliver Caldwell
 * MIT license
 * @preserve
 */
(function(){function c(){}var l=c.prototype;function h(w,x){var v=w.length;while(v--){if(w[v].listener===x){return v}}return -1}function j(v){return function w(){return this[v].apply(this,arguments)}}l.getListeners=function t(v){var y=this._getEvents();var w;var x;if(typeof v==="object"){w={};for(x in y){if(y.hasOwnProperty(x)&&v.test(x)){w[x]=y[x]}}}else{w=y[v]||(y[v]=[])}return w};l.flattenListeners=function r(x){var v=[];var w;for(w=0;w<x.length;w+=1){v.push(x[w].listener)}return v};l.getListenersAsObject=function e(v){var x=this.getListeners(v);var w;if(x instanceof Array){w={};w[v]=x}return w||x};l.addListener=function f(v,y){var x=this.getListenersAsObject(v);var z=typeof y==="object";var w;for(w in x){if(x.hasOwnProperty(w)&&h(x[w],y)===-1){x[w].push(z?y:{listener:y,once:false})}}return this};l.on=j("addListener");l.addOnceListener=function a(v,w){return this.addListener(v,{listener:w,once:true})};l.once=j("addOnceListener");l.defineEvent=function p(v){this.getListeners(v);return this};l.defineEvents=function q(v){for(var w=0;w<v.length;w+=1){this.defineEvent(v[w])}return this};l.removeListener=function b(v,z){var y=this.getListenersAsObject(v);var w;var x;for(x in y){if(y.hasOwnProperty(x)){w=h(y[x],z);if(w!==-1){y[x].splice(w,1)}}}return this};l.off=j("removeListener");l.addListeners=function m(v,w){return this.manipulateListeners(false,v,w)};l.removeListeners=function s(v,w){return this.manipulateListeners(true,v,w)};l.manipulateListeners=function g(w,x,z){var y;var A;var B=w?this.removeListener:this.addListener;var v=w?this.removeListeners:this.addListeners;if(typeof x==="object"&&!(x instanceof RegExp)){for(y in x){if(x.hasOwnProperty(y)&&(A=x[y])){if(typeof A==="function"){B.call(this,y,A)}else{v.call(this,y,A)}}}}else{y=z.length;while(y--){B.call(this,x,z[y])}}return this};l.removeEvent=function o(v){var y=typeof v;var x=this._getEvents();var w;if(y==="string"){delete x[v]}else{if(y==="object"){for(w in x){if(x.hasOwnProperty(w)&&v.test(w)){delete x[w]}}}else{delete this._events}}return this};l.removeAllListeners=j("removeEvent");l.emitEvent=function u(v,x){var A=this.getListenersAsObject(v);var B;var z;var y;var w;for(y in A){if(A.hasOwnProperty(y)){z=A[y].length;while(z--){B=A[y][z];if(B.once===true){this.removeListener(v,B.listener)}w=B.listener.apply(this,x||[]);if(w===this._getOnceReturnValue()){this.removeListener(v,B.listener)}}}}return this};l.trigger=j("emitEvent");l.emit=function k(v){var w=Array.prototype.slice.call(arguments,1);return this.emitEvent(v,w)};l.setOnceReturnValue=function i(v){this._onceReturnValue=v;return this};l._getOnceReturnValue=function n(){if(this.hasOwnProperty("_onceReturnValue")){return this._onceReturnValue}else{return true}};l._getEvents=function d(){return this._events||(this._events={})};if(typeof define==="function"&&define.amd){define(function(){return c})}else{if(typeof module==="object"&&module.exports){module.exports=c}else{this.EventEmitter=c}}}.call(this));
/*!
 * eventie v1.0.3
 * event binding helper
 *   eventie.bind( elem, 'click', myFn )
 *   eventie.unbind( elem, 'click', myFn )
 */
(function(d){var a=document.documentElement;var e=function(){};if(a.addEventListener){e=function(h,g,f){h.addEventListener(g,f,false)}}else{if(a.attachEvent){e=function(h,g,f){h[g+f]=f.handleEvent?function(){var i=d.event;i.target=i.target||i.srcElement;f.handleEvent.call(f,i)}:function(){var i=d.event;i.target=i.target||i.srcElement;f.call(h,i)};h.attachEvent("on"+g,h[g+f])}}}var c=function(){};if(a.removeEventListener){c=function(h,g,f){h.removeEventListener(g,f,false)}}else{if(a.detachEvent){c=function(i,g,f){i.detachEvent("on"+g,i[g+f]);try{delete i[g+f]}catch(h){i[g+f]=undefined}}}}var b={bind:e,unbind:c};if(typeof define==="function"&&define.amd){define(b)}else{d.eventie=b}})(this);
/*!
 * imagesLoaded v3.0.4
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */
(function(f){var d=f.jQuery;var c=f.console;var a=typeof c!=="undefined";function g(k,j){for(var l in j){k[l]=j[l]}return k}var i=Object.prototype.toString;function e(j){return i.call(j)==="[object Array]"}function b(m){var l=[];if(e(m)){l=m}else{if(typeof m.length==="number"){for(var k=0,j=m.length;k<j;k++){l.push(m[k])}}else{l.push(m)}}return l}function h(m,k){function l(q,p,o){if(!(this instanceof l)){return new l(q,p)}if(typeof q==="string"){q=document.querySelectorAll(q)}this.elements=b(q);this.options=g({},this.options);if(typeof p==="function"){o=p}else{g(this.options,p)}if(o){this.on("always",o)}this.getImages();if(d){this.jqDeferred=new d.Deferred()}var r=this;setTimeout(function(){r.check()})}l.prototype=new m();l.prototype.options={};l.prototype.getImages=function(){this.images=[];for(var r=0,o=this.elements.length;r<o;r++){var s=this.elements[r];if(s.nodeName==="IMG"){this.addImage(s)}var u=s.querySelectorAll("img");for(var q=0,t=u.length;q<t;q++){var p=u[q];this.addImage(p)}}};l.prototype.addImage=function(o){var p=new n(o);this.images.push(p)};l.prototype.check=function(){var t=this;var p=0;var r=this.images.length;this.hasAnyBroken=false;if(!r){this.complete();return}function q(v,u){if(t.options.debug&&a){c.log("confirm",v,u)}t.progress(v);p++;if(p===r){t.complete()}return true}for(var o=0;o<r;o++){var s=this.images[o];s.on("confirm",q);s.check()}};l.prototype.progress=function(o){this.hasAnyBroken=this.hasAnyBroken||!o.isLoaded;var p=this;setTimeout(function(){p.emit("progress",p,o);if(p.jqDeferred){p.jqDeferred.notify(p,o)}})};l.prototype.complete=function(){var o=this.hasAnyBroken?"fail":"done";this.isComplete=true;var p=this;setTimeout(function(){p.emit(o,p);p.emit("always",p);if(p.jqDeferred){var q=p.hasAnyBroken?"reject":"resolve";p.jqDeferred[q](p)}})};if(d){d.fn.imagesLoaded=function(p,q){var o=new l(this,p,q);return o.jqDeferred.promise(d(this))}}var j={};function n(o){this.img=o}n.prototype=new m();n.prototype.check=function(){var o=j[this.img.src];if(o){this.useCached(o);return}j[this.img.src]=this;if(this.img.complete&&this.img.naturalWidth!==undefined){this.confirm(this.img.naturalWidth!==0,"naturalWidth");return}var p=this.proxyImage=new Image();k.bind(p,"load",this);k.bind(p,"error",this);p.src=this.img.src};n.prototype.useCached=function(o){if(o.isConfirmed){this.confirm(o.isLoaded,"cached was confirmed")}else{var p=this;o.on("confirm",function(q){p.confirm(q.isLoaded,"cache emitted confirmed");return true})}};n.prototype.confirm=function(o,p){this.isConfirmed=true;this.isLoaded=o;this.emit("confirm",this,p)};n.prototype.handleEvent=function(o){var p="on"+o.type;if(this[p]){this[p](o)}};n.prototype.onload=function(){this.confirm(true,"onload");this.unbindProxyEvents()};n.prototype.onerror=function(){this.confirm(false,"onerror");this.unbindProxyEvents()};n.prototype.unbindProxyEvents=function(){k.unbind(this.proxyImage,"load",this);k.unbind(this.proxyImage,"error",this)};return l}if(typeof define==="function"&&define.amd){define(["eventEmitter/EventEmitter","eventie/eventie"],h)}else{f.imagesLoaded=h(f.EventEmitter,f.eventie)}})(window);

// ======================= END imagesLoaded Plugin ===============================



(function( window, $, undefined ){

  'use strict';

  /*
   * smartresize: debounced resize event for jQuery
   *
   * latest version and complete README available on Github:
   * https://github.com/louisremi/jquery.smartresize.js
   *
   * Copyright 2011 @louis_remi
   * Licensed under the MIT license.
   */

  var $event = $.event,
      dispatchMethod = $.event.handle ? 'handle' : 'dispatch',
      resizeTimeout;

  $event.special.smartresize = {
    setup: function() {
      $(this).bind( "resize", $event.special.smartresize.handler );
    },
    teardown: function() {
      $(this).unbind( "resize", $event.special.smartresize.handler );
    },
    handler: function( event, execAsap ) {
      // Save the context
      var context = this,
          args = arguments;

      // set correct event type
      event.type = "smartresize";

      if ( resizeTimeout ) { clearTimeout( resizeTimeout ); }
      resizeTimeout = setTimeout(function() {
        $event[ dispatchMethod ].apply( context, args );

      }, execAsap === "execAsap"? 0 : 100 );
    }
  };

  $.fn.smartresize = function( fn ) {
    return fn ? this.bind( "smartresize", fn ) : this.trigger( "smartresize", ["execAsap"] );
  };



// ========================= Grid ===============================


  // our "Widget" object constructor
  $.Mason = function( options, element ){
    this.element = $( element );
    this._create( options );
    this._init();
  };

  $.Mason.settings = {
    isResizable: true,
    isAnimated: false,
    animationOptions: {
      queue: false,
      duration: 500,
      //=David Blanco
      complete: function(){// If the plugin doesn't support transformation then load the images when the animation finish
          var $this = $(this);

          if( !$this.hasClass('grid-brick') ){//If is the container (not the boxes)
              if($.fn.grid.defaults.lazyLoad){//Refresh the waypoint
                  $.waypoints('refresh');
              }

              if( $this.hasClass('grid-with-loading-boxes') ){
                  $this.removeClass('grid-with-loading-boxes');
                  $this.addClass('completeAddingImages');
              }
          }
      },
      //=End David Blanco
    },
    gutterWidth: 0,
    isRTL: false,
    isFitWidth: false,
    containerStyle: {
      position: 'relative'
    }
  };

  $.Mason.prototype = {
    //=db
    _resized: false,
    //=End db

    _filterFindBricks: function( $elems ) {
      var selector = this.options.itemSelector;
      // if there is a selector
      // filter/find appropriate item elements
      return !selector ? $elems : $elems.filter( selector ).add( $elems.find( selector ) );
    },

    _getBricks: function( $elems ) {
      var $bricks = this._filterFindBricks( $elems )
        .css({ position: 'absolute' })
        .addClass('grid-brick');
      return $bricks;
    },
    
    // sets up widget
    _create : function( options ) {
      
      this.options = $.extend( true, {}, $.Mason.settings, options );
      this.styleQueue = [];

      // get original styles in case we re-apply them in .destroy()
      var elemStyle = this.element[0].style;
      this.originalStyle = {
        // get height
        height: elemStyle.height || ''
      };
      // get other styles that will be overwritten
      var containerStyle = this.options.containerStyle;
      for ( var prop in containerStyle ) {
        this.originalStyle[ prop ] = elemStyle[ prop ] || '';
      }

      this.element.css( containerStyle );

      this.horizontalDirection = this.options.isRTL ? 'right' : 'left';

      var x = this.element.css( 'padding-' + this.horizontalDirection );
      var y = this.element.css( 'padding-top' );
      this.offset = {
        x: x ? parseInt( x, 10 ) : 0,
        y: y ? parseInt( y, 10 ) : 0
      };
      
      this.isFluid = this.options.columnWidth && typeof this.options.columnWidth === 'function';

      // add grid class first time around
      var instance = this;
      setTimeout( function() {
        instance.element.addClass('grid');
      }, 0 );
      
      // bind resize method
      if ( this.options.isResizable ) {
        $(window).bind( 'smartresize.grid', function() { 
          instance.resize();
        });
      }


      // need to get bricks
      this.reloadItems();

    },
  
    // _init fires when instance is first created
    // and when instance is triggered again -> $el.grid();
    _init : function( callback ) {
      this._getColumns();
      this._reLayout( callback );
    },

    option: function( key, value ){
      // set options AFTER initialization:
      // signature: $('#foo').bar({ cool:false });
      if ( $.isPlainObject( key ) ){
        this.options = $.extend(true, this.options, key);
      } 
    },
    
    // ====================== General Layout ======================

    // used on collection of atoms (should be filtered, and sorted before )
    // accepts atoms-to-be-laid-out to start with
    layout : function( $bricks, callback ) {

      // place each brick
      for (var i=0, len = $bricks.length; i < len; i++) {
        this._placeBrick( $bricks[i] );
      }
      
      // set the size of the container
      var containerSize = {};
      containerSize.height = Math.max.apply( Math, this.colYs );
      if ( this.options.isFitWidth ) {
        var unusedCols = 0;
        i = this.cols;
        // count unused columns
        while ( --i ) {
          if ( this.colYs[i] !== 0 ) {
            break;
          }
          unusedCols++;
        }
        // fit container to columns that have been used;
        containerSize.width = (this.cols - unusedCols) * this.columnWidth - this.options.gutterWidth;
      }
      this.styleQueue.push({ $el: this.element, style: containerSize });

      // are we animating the layout arrangement?
      // use plugin-ish syntax for css or animate
      var styleFn = !this.isLaidOut ? 'css' : (
            this.options.isAnimated ? 'animate' : 'css'
          ),
          animOpts = this.options.animationOptions;

      // process styleQueue
      var obj;
      //=David Blanco
      var loading = false;
      //=End David Blanco
      for (i=0, len = this.styleQueue.length; i < len; i++) {
        obj = this.styleQueue[i];

        //=David Blanco
        styleFn = !this.isLaidOut ? 'css' : ( this.options.isAnimated ? 'animate' : 'css' );

        var loadingBox = obj.$el.hasClass('loading-box');
        if( loadingBox && !this.element.hasClass('noSupportTransform') ){
            styleFn = 'css';
            loading = true;
        }else if(loading){//for the container
            obj.$el[ 'css' ]( obj.style, animOpts );
        }
        obj.$el.removeClass('loading-box');

        var left = obj.$el.css('left');
        var top  = obj.$el.css('top');

        var newLeft = obj.style.left+'px';
        var newTop  = obj.style.top+'px';

        if( ( left==newLeft && top==newTop ) || loadingBox==true){
          //console.log('is not going to move...');
          obj.$el.data('moving', false);
        }else{
          //console.log('is going to move...');
          obj.$el.data('moving', true);
        }

        var durationAnim = 500;

        //=End David Blanco

        obj.$el[ styleFn ]( obj.style, animOpts );
      }

      // clear out queue for next time
      this.styleQueue = [];

      // provide $elems as context for the callback
      if ( callback ) {
        callback.call( $bricks );
      }
      
      this.isLaidOut = true;
    },
    
    // calculates number of columns
    // i.e. this.columnWidth = 200
    _getColumns : function() {
      var container = this.options.isFitWidth ? this.element.parent() : this.element,
          containerWidth = container.width();
                         // use fluid columnWidth function if there
      this.columnWidth = this.isFluid ? this.options.columnWidth( containerWidth ) :
                    // if not, how about the explicitly set option?
                    this.options.columnWidth ||
                    // or use the size of the first item
                    this.$bricks.outerWidth(true) ||
                    // if there's no items, use size of container
                    containerWidth;

      this.columnWidth += this.options.gutterWidth;

      this.cols = Math.floor( ( containerWidth + this.options.gutterWidth ) / this.columnWidth );
      this.cols = Math.max( this.cols, 1 );

    },

    // layout logic
    _placeBrick: function( brick ) {
      var $brick = $(brick),
          colSpan, groupCount, groupY, groupColY, j;

      //how many columns does this brick span
      colSpan = Math.ceil( $brick.outerWidth(true) / this.columnWidth );
      colSpan = Math.min( colSpan, this.cols );

      if ( colSpan === 1 ) {
        // if brick spans only one column, just like singleMode
        groupY = this.colYs;
      } else {
        // brick spans more than one column
        // how many different places could this brick fit horizontally
        groupCount = this.cols + 1 - colSpan;
        groupY = [];

        // for each group potential horizontal position
        for ( j=0; j < groupCount; j++ ) {
          // make an array of colY values for that one group
          groupColY = this.colYs.slice( j, j+colSpan );
          // and get the max value of the array
          groupY[j] = Math.max.apply( Math, groupColY );
        }

      }

      // get the minimum Y value from the columns
      var minimumY = Math.min.apply( Math, groupY ),
          shortCol = 0;
      
      // Find index of short column, the first from the left
      for (var i=0, len = groupY.length; i < len; i++) {
        if ( groupY[i] === minimumY ) {
          shortCol = i;
          break;
        }
      }

      // position the brick
      var position = {
        top: minimumY + this.offset.y
      };
      // position.left or position.right
      position[ this.horizontalDirection ] = this.columnWidth * shortCol + this.offset.x;
      this.styleQueue.push({ $el: $brick, style: position });

      // apply setHeight to necessary columns
      var setHeight = minimumY + $brick.outerHeight(true),
          setSpan = this.cols + 1 - len;
      for ( i=0; i < setSpan; i++ ) {
        this.colYs[ shortCol + i ] = setHeight;
      }

    },
    
    
    resize: function() {
      var prevColCount = this.cols;
      // get updated colCount
      this._getColumns();
      if ( this.isFluid || this.cols !== prevColCount ) {
        // if column count has changed, trigger new layout
        this._reLayout();
      }
    },
    
    
    _reLayout : function( callback ) {
      // reset columns
      var i = this.cols;
      this.colYs = [];
      while (i--) {
        this.colYs.push( 0 );
      }
      // apply layout logic to all bricks
      this.layout( this.$bricks, callback );
    },
    
    // ====================== Convenience methods ======================
    
    // goes through all children again and gets bricks in proper order
    reloadItems : function() {
      this.$bricks = this._getBricks( this.element.children() );
    },
    
    
    reload : function( callback ) {
      this.reloadItems();
      this._init( callback );
    },
    

    // convienence method for working with Infinite Scroll
    appended : function( $content, isAnimatedFromBottom, callback ) {

      if ( isAnimatedFromBottom ) {
        // set new stuff to the bottom
        this._filterFindBricks( $content ).css({ top: this.element.height() });
        var instance = this;
        setTimeout( function(){
          instance._appended( $content, callback );
        }, 1 );
      } else {
        this._appended( $content, callback );
      }
    },
    
    _appended : function( $content, callback ) {
      var $newBricks = this._getBricks( $content );
      // add new bricks to brick pool
      this.$bricks = this.$bricks.add( $newBricks );
      this.layout( $newBricks, callback );
    },
    
    // removes elements from Grid widget
    remove : function( $content ) {
      this.$bricks = this.$bricks.not( $content );
      $content.remove();
    },
    
    // destroys widget, returns elements and container back (close) to original style
    destroy : function() {

      this.$bricks
        .removeClass('grid-brick')
        .each(function(){
          this.style.position = '';
          this.style.top = '';
          this.style.left = '';
        });
      
      // re-apply saved container styles
      var elemStyle = this.element[0].style;
      for ( var prop in this.originalStyle ) {
        elemStyle[ prop ] = this.originalStyle[ prop ];
      }

      this.element
        .unbind('.grid')
        .removeClass('grid')
        .removeData('grid');
      
      $(window).unbind('.grid');

    }
    
  };
  

  // =======================  Plugin bridge  ===============================
  // leverages data method to either create or return $.Mason constructor
  // A bit from jQuery UI
  //   https://github.com/jquery/jquery-ui/blob/master/ui/jquery.ui.widget.js
  // A bit from jcarousel 
  //   https://github.com/jsor/jcarousel/blob/master/lib/jquery.jcarousel.js



  $.fn.grid = function( options ) {
    //=db

    var db = function($this){
        var ops = $.extend({}, $.fn.grid.defaults, options);

        if( ops.visibleCaption ){
            ops.caption = false;
        }

        if(options != undefined && options.lazyLoad != undefined){
            $.fn.grid.defaults.lazyLoad = options.lazyLoad;
        }
        
        if(options == undefined){
          options = {};
        }

        options.isFitWidth = ops.isFitWidth;
        options.isAnimated = ops.isAnimated; 
        options.itemSelector = '.gbox';
        options.gutterWidth = ops.horizontalSpaceBetweenThumbnails;
        /* *************************************** ADJUST THE WIDTH OF THE COLUMNS *************************************** */
        var $container = $($this).addClass("centered").addClass("grid-clearfix");
        var $op        = ops.columnWidth;

        if($op == 'auto'){
            options.columnWidth = function(containerWidth){
                                      var box_width =  -999; //Just making sure that at least enters once to the condition below
                                      for(var i=ops.columns; i>=1; i--){
                                          if(box_width < ops.columnMinWidth){
                                              box_width = (((containerWidth - (i-1)*options.gutterWidth)/i) | 0);
                                          }
                                      }

                                      //box_width = 280;
                                      $container.find('div.gbox').width(box_width);
                                      return box_width;
                                  };

        }else if( (typeof $op)!= 'function' ){
            options.columnWidth = function(containerWidth){
                                      var box_width =  $op;

                                      $container.find('div.gbox').width(box_width);
                                      return box_width;
                                  };
        }


        $container.find('div.gbox').css('margin-bottom', ops.verticalSpaceBetweenThumbnails);

        var supports = (function() {  
            var   div = document.createElement('div'),  
              vendors = 'Khtml ms O Moz Webkit'.split(' '),  
                  len = vendors.length;  

            return function(prop) {  
              if ( prop in div.style ) return true;  

              prop = prop.replace(/^[a-z]/, function(val) {  
                 return val.toUpperCase();  
              });  

              while(len--) {  
                 if ( vendors[len] + prop in div.style ) {  
                    // browser supports box-shadow. Do what you need.  
                    // Or use a bang (!) to test if the browser doesn't.  
                    return true;  
                 }   
              }  
              return false;  
            };  
        })(); 

        if ( !supports('transform') ) { //IF IT DOES NOT SUPPORT SCALE PROPERTY FOR IE8 for example
             $container.addClass('noSupportTransform');
        }else{
              $container.addClass('visible');
        }


        var rsJSON = null;
        var $directory = $container.data('directory');
        var $categoryNavBar = $('<ul class="category-navbar" />').hide().insertBefore($container);
        /* *************************************** BRING IMAGES TO THE PARTY *************************************** */
        
        var getCurrentCategory = function(){
              var filter = $categoryNavBar.find('li[class=select]').data('category');
              return filter;
        }

        var loadMore = $('<div />').insertAfter($container);

        var addLoading = function(){
            loadMore.addClass('grid-loader').removeClass('grid-loadMore').html('');
        };

        var clearLoading = function(){
            loadMore.removeClass('grid-loader');
        };

        var loadingScroll = false;
        var anyMoreImages = function(category){

            var cont = 0;

            for (var key in rsJSON) {
               var cat = rsJSON[key];
               if(category == key || category == 'all'){
                  for (var img in cat) {
                      cont++;
                  }
               }
            }

            if(cont>0){
                loadingScroll = false;
                return true;
            }else{
                return false;
            }

        };

        var fixLoadMoreButton = function(result){

              if(result){
                  loadMore.addClass('grid-loadMore').html('LOAD MORE IMAGES');
              }else{
                  loadMore.removeClass('grid-loadMore').html('');
              }

        };

        var makeBox = function(category, imgName, thumb){
            
            var thumbFolder = 'thumbnails/';
            if(thumb == 'no'){
                thumbFolder = '';
            }

            var categoryURL = category+'/';
            if(category == 'all'){
              categoryURL = '';
            }

            var imgTitle = imgName.split(/\.(?=[^.]*$)/)[0];

            var categoryHTML = '<h5>In '+category+'</h5>';

            if(category == 'all' || ops.captionCategory == false){
                categoryHTML = '';
            }

            var url = '';
            if(imgTitle.indexOf("$$") != -1){
                var arr = imgTitle.split("$$");
                imgTitle = arr[0];

                console.log(arr);

                var link = arr[1].split(':').join('/');
                link = link.split('|').join('/');
                link = link.split('^').join('/');

                url = 'data-url="'+link+'"';
            }

            if( imgTitle.substr(1,1) == '-' ){
                imgTitle = imgTitle.substr(2);
            }

            var classVisible  = '';
            var lastFirst     = '';
            if( ops.visibleCaption ){
                classVisible = 'visible-caption';
            }            

            var box ='<div class="gbox" data-category="'+category+'" '+url+'>'+
                          '<img src="'+$directory+'/'+categoryURL+thumbFolder+imgName+'" data-lightbox="'+$directory+'/'+categoryURL+imgName+'" />'+
                                '<div class="image-caption '+classVisible+'">'+
                                      '<h3>'+imgTitle+'</h3>'+
                                      categoryHTML+
                                '</div>'+
                          '<div class="lightbox-text">'+
                                imgTitle+' <span>In '+category+'</span>'+
                          '</div>'+
                      '</div>';

            

            return box;
        };

        var verifyNavBar = function(){
            var category = getCurrentCategory();

            if(category != 'all'){
                $container.children('div').not('.gbox[data-category="'+category+'"]')
                            .removeClass("gbox grid-brick")
                            .hide();
            }
            
        }


        var waitUntilLoad = function(boxes){
            boxes = $(boxes).addClass('loading-box');
            //APPLY THE MARGIN BOTTOM THAT WAS SET
            boxes.css('margin-bottom', ops.verticalSpaceBetweenThumbnails);

            //ADD IT TO THE PARTY AND HIDE IT UNTIL IT LOAD
            $container.append( boxes.hide() );
            
            $container.imagesLoaded(function(){
                boxes.hide();

                verifyNavBar();

                $container.addClass('grid-with-loading-boxes');
                $container.grid('reload');

                var boxesShow = [];
                boxesShow.push(boxes);
                specialAnimation(boxesShow, []);

                clearLoading();
                fixLoadMoreButton( anyMoreImages(getCurrentCategory()) );
                loadingScroll = false;
            });
        };

        //CUSTOMIZATION --> 
        /**
         * Return an Object sorted by it's Key
         */
        var sortObjectByKey = function(obj){
            var keys = [];
            var sorted_arr = Array();

            for(var key in obj){
                if(obj.hasOwnProperty(key)){
                    keys.push(obj[key].order.toLowerCase()+"-&$&$-"+key);
                }
            }
            
            // sort keys
            keys.sort();
            if( ops.imagesOrder == "byName" || ops.imagesOrder == "byDateReverse" ){
                //do nothing
            } else {
                //Reverse order
                keys.reverse();
            }
            
            // create new array based on Sorted Keys
            jQuery.each(keys, function(i, key){
                var index = key.split('-&$&$-');
                index = index[1];
                sorted_arr.push( obj[index] );
            });

            return sorted_arr;
        };

        var loadImages = function(numberImagesToLoad){
            addLoading();

            //GET THE CATEGORY WITH THE MAXIUM NUMBER OF IMAGES
            var max = 0; 
            for(var key in rsJSON){
                var category = rsJSON[key];
                var length = 0;
                for (var img in category) { length++; } 

                if(length>max)max=length;
            }


            //GET THE IMAGES FROM ALL FOLDERS
            var collection = new Array();
            if(ops.aleatoryImagesFromCategories){
                for(var i=0; i<max; i++){

                    var cont = 0;
                    for(var key in rsJSON){
                      category = rsJSON[key];
                      var keyTmp = key;
                      if(cont == 0){
                          keyTmp = 'all';  
                      }
                      var cont2 = 0;
                      for (var img in category) {
                          
                          if(cont2 == i){
                            //CUSTOMIZATION-->
                            collection.push({ 'category':keyTmp, 'image':img, 'thumb': category[img].thumb, 'order': category[img].order, 'categoryOriginal': key  });
                            break;
                          }
                          cont2++;
                      }
                      cont++;
                    }

                }
            }else{
                var cont = 0;
                for (var key in rsJSON) {
                   var category = rsJSON[key];
                   var keyTmp = key;
                   if(cont == 0){
                      keyTmp = 'all';  
                   }
                   for (var img in category) {
                      //CUSTOMIZATION-->
                      collection.push({ 'category':keyTmp, 'image':img, 'thumb': category[img].thumb, 'order': category[img].order, 'categoryOriginal': key });
                   }

                   cont++;
                }
            }

            //CUSTOMIZATION
            if( ops.orderInAll && ops.imagesOrder != 'random' ){
                collection = sortObjectByKey(collection);
            }

            var boxes = "";
            var num = 0;
            while(num<numberImagesToLoad){
                if(num>=collection.length)break;

                var obj = collection[num];
                boxes += makeBox(obj['category'], obj['image'], obj['thumb']);

                //DELTE THE IMAGES THAT ARE ALREADY IN THE GRID BECAUSE WE DON'T NEED THEM ANYMORE
                delete rsJSON[ obj['categoryOriginal'] ] [obj['image']];

                num++;
            }

            waitUntilLoad(boxes);
        }

        var loadImagesByCategory = function(numberImagesToLoad, currentCategory){
            addLoading();

            //GET THE IMAGES FROM ALL FOLDERS
            var collection = new Array();
            
            var cont = 0;
            for (var key in rsJSON) {
               var category = rsJSON[key];
               var keyTmp = key;
               if(cont == 0){
                  keyTmp = 'all';  
               }

               if(keyTmp == currentCategory){
                 for (var img in category) {
                    //CUSTOMIZATION-->
                    collection.push({ 'category':keyTmp, 'image':img, 'thumb': category[img].thumb, 'order': category[img].order, 'categoryOriginal': key });
                 }
               }

               cont++;
            }

            //CUSTOMIZATION
            if( ops.orderInAll && ops.imagesOrder != 'random' ){
                collection = sortObjectByKey(collection);
            }

            var boxes = "";
            var num = 0;
            while(num<numberImagesToLoad){
                if(num>=collection.length)break;

                var obj = collection[num];
                boxes += makeBox(obj['category'], obj['image'], obj['thumb']);

                //DELTE THE IMAGES THAT ARE ALREADY IN THE GRID BECAUSE WE DON'T NEED THEM ANYMORE
                delete rsJSON[ obj['categoryOriginal'] ] [obj['image']];

                num++;
            }

            waitUntilLoad(boxes);
        }

        var loadTrigger = function(){
            if(loadMore.hasClass('grid-loadMore')){
                var cat = getCurrentCategory();
                if(cat == 'all'){
                    loadImages(ops.imagesToLoad);
                }else{
                    loadImagesByCategory(ops.imagesToLoad, cat);
                }
            }
        }

        loadMore.on('click', function(){
            loadTrigger();
        });

        /*if(ops.lazyLoad){
          $(window).scroll(function(){
            if(loadMore.closest('html').length){
              if( ($(window).scrollTop() == ($(document).height() - $(window)[0].innerHeight)) && loadingScroll==false ){        
                loadingScroll = true; 
                loadTrigger();
              }
            }
          });
        }*/

        if(ops.lazyLoad){
            
            loadMore.waypoint(function(direction) {
              var $this = $container;
              if( $this.hasClass('completeAddingImages') ){                  
                  if(loadMore.hasClass('grid-loadMore')){
                      loadTrigger();
                      $this.removeClass('completeAddingImages');
                  }
              }
            }, {
              context: window,
              continuous: true,
              enabled: true,
              horizontal: false,
              offset: 'bottom-in-view',
              triggerOnce: false,   
            });

        }

        /* *************************************** NAVIGATION BAR FILTER *************************************** */

        var makeNavBar = function(){
            var cont = 0;
            for (var key in rsJSON) {

              var categoryName = key;
              if( categoryName.substr(1,1) == '-' ){
                categoryName = categoryName.substr(2);
              }

               var $li = $('<li />').data('category',key).appendTo($categoryNavBar);
               $('<a />').html(categoryName).appendTo($li);

               if(cont == 0){
                  $li.addClass('select');
                  $li.data('category','all');
               }

               cont++;
            }

            if(ops.smartNavBar && cont<=2){
                ops.showNavBar = false;
            }

            if(ops.showNavBar){
                $categoryNavBar.slideDown(400);
            }
        };

        var specialAnimation = function(boxesShow, boxesHide){
            //BOXES TO SHOW HERE ---->
            for(var i=0; i<boxesShow.length; i++){
                boxesShow[i].each(function(){
                    var el = $(this).removeClass('noTransform');

                    if(el.hasClass('grid-brick')){//MAKE SURE THE BOX IS GOING TO BE SHOWN
                          if( el.is(':hidden') ){
                              if ( $container.hasClass('noSupportTransform') ) { //IF IT DOES NOT SUPPORT SCALE PROPERTY FOR IE8 for example
                                  el.show();
                              }else{
                                  el.show();
                                  
                                  if(el.data('moving') == false){
                                      el.animate(ops.hiddenStyle,0);  
                                      el.animate(ops.visibleStyle, 400, function(){ el.addClass('noTransform'); });
                                  }else{
                                      el.animate(ops.visibleStyle, 0); //If is hidden and it is going to move make sure it is visible
                                      el.addClass('noTransform');
                                  }
                              }
                          }else{
                            el.animate(ops.visibleStyle,options.animOpts, function(){ el.addClass('noTransform'); });
                          }
                    } 

                });
            }

            //BOXES TO HIDE HERE --->
            for(var i=0; i<boxesHide.length; i++){
                boxesHide[i].each(function(){
                    var el = $(this).removeClass('noTransform');
                    if( el.is(':hidden') == false ){
                        
                        el.addClass('box');
                        if ( $container.hasClass('noSupportTransform') ) { //IF IT DOES NOT SUPPORT SCALE PROPERTY FOR IE8 for example
                             el.hide();
                             el.removeClass('box'); 
                        }else{
                            el.animate(ops.visibleStyle,0);  
                            el.animate(ops.hiddenStyle, options.animOpts, function(){
                                el.hide();
                                el.removeClass('box');
                            });
                        }
                        
                    }else{
                      //do nothing
                    }
                });
            }

        }

        console.log(base_url+"/streamreader?directory="+$directory+'&categoriesOrder='+ops.categoriesOrder+'&imagesOrder='+ops.imagesOrder);
        /* ************ BRING INFORMATION THROUGH JSON ********* */
        $.getJSON(base_url+"/streamreader?directory="+$directory+'&categoriesOrder='+ops.categoriesOrder+'&imagesOrder='+ops.imagesOrder,function(data){ 
            rsJSON = data;

            console.log(data);

            if( jQuery.isArray( data['All'] ) ){
                data['All'] = {};
            }
            
            $categoryNavBar.css('display','none');

            makeNavBar();

            loadImages(ops.imagesToLoadStart);
        });


        $categoryNavBar.on('click', 'a', function(evt){
            evt.preventDefault();

            var $this = jQuery(this);

            if($this.parent('li').hasClass('select')){
                return;
            }

            //so the lazy load doesnt trigger until the filtering is finish
            $container.removeClass('completeAddingImages');
            $container.addClass('grid-with-loading-boxes');

            $this.parent('li').addClass('select').siblings('li').removeClass('select');

            var elem =  $container;
            var filter = $this.parent('li').data('category');

            var boxesShow = [];
            var boxesHide = [];

            if(filter == 'all'){
                var all = elem.children('div').addClass('gbox grid-brick');
                if ( $container.hasClass('noSupportTransform') ) { 
                    all.css({'top': 200, 'left': 200});
                } 
                boxesShow.push( all );
            }else{
                var category = elem.children('div[data-category="'+filter+'"]').addClass('gbox grid-brick');
                if(category[0] != undefined){
                    if ( $container.hasClass('noSupportTransform') ) { 
                        category.css({'top': 200, 'left': 200});
                    }
                    boxesShow.push( category.stop() );
                }


                var hide     = elem.children('div').not('.gbox[data-category="'+filter+'"]').removeClass("gbox grid-brick");

                boxesHide.push( hide );
                            
            }

            $container.grid('reload');

            //-------  SPECIAL ANIMATION ------->

            specialAnimation(boxesShow, boxesHide);

            //-------  END SPECIAL ANIMATION ------->

            fixLoadMoreButton( anyMoreImages(getCurrentCategory()) );

        });



        /* *************************************** CAPTIONS *************************************** */

        $container.on( 'mouseenter.hoverdir, mouseleave.hoverdir', 'div.gbox', function( event ) {
            if(!ops.caption)return;
                
            var $el         = $(this),
                evType      = event.type,
                $hoverElem  = $el.find( 'div.image-caption' ),
                direction   = _getDir( $el, { x : event.pageX, y : event.pageY } ),
                cssPos    =   _getPosition( direction, $el );
            
            
            //ALIGNMENT
            var child = $hoverElem.children('div.aligment');
            if(child[0] == undefined){
                var tmpHTML = $hoverElem.html();
                $hoverElem.html("<div class='aligment'><div class='aligment'>"+tmpHTML+"</div></div>");
            }

            if( evType === 'mouseenter' ) {
                if(ops.captionType == 'classic'){
                    $hoverElem.css( { "left" : 0, "top" : 0 } );
                    $hoverElem.fadeIn(300);
                    return;
                }

                $hoverElem.css( { "left" : cssPos.from, "top" : cssPos.to } );
              
                $hoverElem.stop().show().fadeTo(0, 1, function() {
                                                    $(this).stop().animate( { "top" : 0, "left" : 0 } , 200, "linear" );
                                                } );
                
            }
            else {

                if(ops.captionType == 'classic'){
                    $hoverElem.css( { "left" : 0, "top" : 0 } );
                    $hoverElem.fadeOut(300);
                    return;
                }
              
                if(ops.captionType == 'grid-fade'){
                      $hoverElem.fadeOut(700);
                }else{
                      $hoverElem.stop().animate( { "left" : cssPos.from, "top" : cssPos.to }, 200, "linear", function(){$hoverElem.hide();} );
                }

            }
                
        } );

        var _getDir = function( $el, coordinates ) {
            /** the width and height of the current div **/
            var w = $el.width(),
                h = $el.height(),

                /** calculate the x and y to get an angle to the center of the div from that x and y. **/
                /** gets the x value relative to the center of the DIV and "normalize" it **/
                x = ( coordinates.x - $el.offset().left - ( w/2 )) * ( w > h ? ( h/w ) : 1 ),
                y = ( coordinates.y - $el.offset().top  - ( h/2 )) * ( h > w ? ( w/h ) : 1 ),
            
                /** the angle and the direction from where the mouse came in/went out clockwise (TRBL=0123);**/
                /** first calculate the angle of the point, 
                add 180 deg to get rid of the negative values
                divide by 90 to get the quadrant
                add 3 and do a modulo by 4  to shift the quadrants to a proper clockwise TRBL (top/right/bottom/left) **/
                direction = Math.round( ( ( ( Math.atan2(y, x) * (180 / Math.PI) ) + 180 ) / 90 ) + 3 )  % 4;
            
            return direction;
            
        };

        var _getPosition = function( direction, $el ) {
            var fromLeft, fromTop;
            switch( direction ) {
                case 0:
                    // from top
                    if ( !ops.reverse ) { 
                            fromLeft = 0, fromTop = - $el.height() 
                    }else {  
                            fromLeft = 0, fromTop = - $el.height()  
                    }
                    break;
                case 1:
                    // from right
                    if ( !ops.reverse ) { 
                            fromLeft = $el.width()  , fromTop = 0
                    }else {  
                            fromLeft = - $el.width() , fromTop = 0 
                    }
                    break;
                case 2:
                    // from bottom
                    if ( !ops.reverse ) { 
                            fromLeft = 0 , fromTop = $el.height() 
                    }
                    else {  
                            fromLeft = 0, fromTop = - $el.height()  
                    }
                    break;
                case 3:
                    // from left
                    if ( !ops.reverse ) {
                            fromLeft = -$el.width()  , fromTop = 0
                    }
                    else {  
                            fromLeft =  $el.width(), fromTop = 0 
                    }
                    break;
            };
            return { from : fromLeft, to: fromTop };
        }; 

        /* *************************************** LIGHTBOX *************************************** */
        var $body           = $('body');

        var vars = {
            interval: 'none'
        };

        var currentIndex    = 0;
        //Container with the black Background
        var $lightbox       = $('<div class="autoGrid-lightbox" />').appendTo($body); 
        //Navigation Bar
        var $lbnav          = $('<div class="autoGrid-nav" />').appendTo($lightbox);

        var $navClose       = $('<div class="autoGrid-close" />').appendTo($lbnav);
        var $iconClose      = $('<i class="iconClose" />').appendTo($navClose);


        var $navPlay       = $('<div class="autoGrid-play" />');
        if(ops.lightboxPlayBtn){
            $navPlay.appendTo($lbnav);
        }
        var $iconPlay      = $('<i class="iconPlay" />').appendTo($navPlay);


        var $navCaption     = $('<div class="autoGrid-lbcaption" />').appendTo($lbnav).html("Here will go the text for the lightbox");

        var $navNext        = $('<div class="autoGrid-next" />').appendTo($lbnav);
        var $iconNext       = $('<i class="iconNext" />').appendTo($navNext);

        var $navPrev        = $('<div class="autoGrid-prev" />').appendTo($lbnav);
        var $iconPrev       = $('<i class="iconPrev" />').appendTo($navPrev);

        var $lightboxTimer  = $('<div class="lightbox-timer" />').appendTo($lightbox);

        var $closeWidth       = $navClose.width();

        var numOptions = 3;
        if(ops.lightboxPlayBtn)numOptions = 4;

        var fixImage = function(){
                var navWidth    = $lightbox.outerWidth();
                if(navWidth<650){//For responsive purpose
                    $navCaption.hide();
                    $navNext.css('width', (navWidth/numOptions));
                    $navPrev.css('width', (navWidth/numOptions));
                    $navPlay.css('width', (navWidth/numOptions));
                    $navClose.css('width', navWidth-((navWidth/numOptions)*(numOptions-1)) );
                }else{
                    $navCaption.show();
                    $navNext.css('width', $closeWidth );
                    $navPrev.css('width', $closeWidth );
                    $navPlay.css('width', $closeWidth );
                    $navClose.css('width', $closeWidth );
                }

                var img         = $lightbox.find('img');
                var maxHeight   = $lightbox.outerHeight()-$lbnav.outerHeight();
                img.css('max-height', maxHeight);

                //FIX IFRAME
                var iframe      = $lightbox.find('iframe');
                var maxHeight   = $lightbox.outerHeight()-$lbnav.outerHeight();
                if(maxHeight != 0){
                    iframe.css('max-height', maxHeight);
                }else{
                    iframe.css('max-height', 'none');
                }
        };

        jQuery(window).resize(function(){
            fixImage();
        });

        var currentImage = new Image();

        var clearCurrentImage = function(){
            if(currentImage != null){
                currentImage.onload = null;
                currentImage        = null;
            }

            $lightbox.find('.lightbox-alignment').remove();
            $lightbox.find('.lightbox-alignment2').remove();
            $lightbox.find('img').remove();
        }

        var clearCurrentIframe = function(){
            $lightbox.find('iframe').remove();
        }

        var clearLoader = function(){
            $lightbox.find('.lb-loader').remove();
        }

        var addLoader = function(){
            $lightbox.append('<div class="lb-loader"/>');
        }

        //DISABLE TEXT SELECTION
        $lightbox.attr('unselectable', 'on').css('user-select', 'none').on('selectstart', false);

        //stop timer
        var stopTimer = function(){
            $lightboxTimer.stop( true, true ).width( 0 );
        };

        var stopInterval = function(){
            clearInterval(vars.interval);
        };

        //update timer
        var updateTimer = function(){
            if(ops.lightBoxShowTimer == false)return;
            $lightboxTimer.css({'position': 'absolute', 'bottom':0}).animate( { width: '100%' }, ops.lightBoxPlayInterval, 'linear', function(){ stopTimer(); } );
        };

        

        var playing = false;
        var closing = false;

        //Play slideshow
        var play = function(){
            vars.interval = setTimeout(function(){
                next();   
            }, ops.lightBoxPlayInterval);

            updateTimer();
        }
        
        //WHEN THE LIGHTBOX FINISH TO LOAD AN IMAGE
        var finish = function(){
            if(playing && closing==false){
                stopTimer();
                stopInterval();
                play();
            }
        }

        var loadIframe = function(iframeUrl){
              var destination = $('<iframe src="'+iframeUrl+'" class="lightbox-iframe" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>');
              
              $lightbox.append(destination.hide());

              var jIframe = destination[0];
              if (jIframe.attachEvent){// FOR IE
                  jIframe.attachEvent('onload',function(){
                    clearLoader();

                    destination.fadeIn(ops.lightBoxSpeedFx, function(){ finish(); });

                    fixImage();
                    currentImage = new Image();
                  });
              } else { // FOR OTHER BROWSERS
                  jIframe.onload = function(){
                      clearLoader();

                      destination.fadeIn(ops.lightBoxSpeedFx, function(){ finish(); });

                      fixImage();
                      currentImage = new Image();
                  }
              }
        }

        var $currentImage = $('<span />');
        var loadImage = function(image, firstTime){
                //Clear image and loader
                clearCurrentIframe();
                clearCurrentImage();
                clearLoader();

                //Add a loader
                addLoader();

                var scale = 0;
                var fade  = 0;
                if(firstTime != true){
                  scale = .9;
                  fade  = ops.lightBoxSpeedFx;
                }
                if(ops.lightBoxZoomAnim == false){
                  scale = 1;
                }
                
                //GET THE SRC OF THE IMAGE THAT WILL BE SHOWN IN THE LIGHTBOX
                var thumbnail = image;
                var src = thumbnail.data('lightbox');

                if(src == undefined){
                    src = thumbnail.attr('src');
                }

                //ADD TEXT TO THE LIGHTBOX
                var text    = thumbnail.siblings('div.lightbox-text').html();
                if(ops.lightBoxText == false){
                    text = "";
                }
                var txt = "<div><div>"+text+"</div></div>";
                $navCaption.html(txt);

                //------> LOAD IFRAME IF THERE'S ONE
                var iframeUrl = '';
                for (var img in ops.videos) {
                    if(src == $directory+'/'+img){
                      iframeUrl = ops.videos[img];
                      break;
                    }
                }

                if( iframeUrl != '' ){
                    loadIframe(iframeUrl);
                    return;
                }
                //------>

                //LOAD THE NEW IMAGE
                currentImage = new Image();
                var $img = $(currentImage);
                var tmp = currentImage;

                currentImage.onload = function() {
                    if(tmp!=currentImage)return;
                    
                    clearLoader();
                    
                    var div1 = $('<div class="lightbox-alignment"></div>').appendTo($lightbox);
                    var div2 = $('<div class="lightbox-alignment2"></div>').appendTo(div1);
                    div2.append($img.css('margin-top', -$lbnav.outerHeight()).hide().scale(scale));

                    $img.fadeIn(fade).animate({
                        scale: '1'
                    },  {duration : ops.lightBoxSpeedFx , complete: function(){ finish(); } });

                    fixImage();
                    
                };

                /*currentImage.onerror=function(){
                    clearLoader();
                    alert("Error Loading the Image in this url: "+currentImage.src);
                }*/

                currentImage.src = src;
                $currentImage.stop(true);
                $currentImage = $(currentImage);

        };

        var lightboxOpen          = false;
        var urlToLinkForLightbox  = '';

        //Open Light Box
        $container.on('click', 'div.gbox', function(){
            lightboxOpen = true;
            var $this = $(this);

            var url = $this.data('url');
            
            urlToLinkForLightbox = '';
            if(url != undefined && ops.linkOnLightbox == true){
                urlToLinkForLightbox = "http://"+url;
            }else if(url != undefined){
                window.location.href="http://"+url;
                //window.open("http://"+url , '_blank');
                return;
            }

            if(ops.lightBox == false){
              return;
            }

            closing = false;

            //$body.css('overflow', 'hidden');

            //set current index
            currentIndex = $container.find('.gbox').index(this);

            var img = $this.children('img');

            //ANIMATE THE NAVIGATION BAR OF THE LIGHTBOX
            $lbnav.animate({
                                'margin-top': 0
                            }, ops.lightBoxSpeedFx);
            
            //SHOW THE LIGHTBOX
            $lightbox.fadeIn(ops.lightBoxSpeedFx);

            loadImage(img, true);

        });

        //Stop propagation
        $lightbox.on('click', 'div', function(e){
            e.stopPropagation();
        });
        $lightbox.on('click', 'img', function(e){
            e.stopPropagation();
        });

        //Close Light Box
        $lightbox.on('click', '.lightbox-alignment', function(){
            close();
        });

        //Close Light Box
        $lightbox.on('click', '.lightbox-alignment2', function(){
            close();
        });

        //Close Light Box
        $lightbox.on('click', function(){
            close();
        });

        $navClose.on('click', function(){
            close();
        });

        var close = function(){
            clearCurrentIframe();

            if(ops.lightBoxStopPlayOnClose){
                $navPlay.removeClass('selected');
                playing = false;
            }

            lightboxOpen = false;
            closing = true;
            stopTimer();
            stopInterval();

            $lightbox.find('.lb-loader').remove();
            var scale = 0;
            if(ops.lightBoxZoomAnim == false){
              scale = 1;
            }

            var currentImg = $lightbox.find('img').stop().show();
            $lbnav.animate({
                                'margin-top': -$lbnav.outerHeight()
                            }, ops.lightBoxSpeedFx);

            if(currentImg[0] != undefined){
                currentImg.animate({
                          scale: scale
                      }, ops.lightBoxSpeedFx, function(){
                          $lightbox.fadeOut(100);
                          //$body.css('overflow', 'auto');
                      } );
              }else{
                  $lightbox.fadeOut(100);
                  //$body.css('overflow', 'auto');
              }

            
        };

        //Next Post
        var next = function(){
            closing = false;
            var boxes = $container.find('.gbox');

            currentIndex+=1;

            if(currentIndex >= boxes.length){
              currentIndex = 0;
            }

            if(!boxes.eq(currentIndex).is(":visible")){//If next is not visible then find the some one that is.
                var cont = currentIndex;
                for(var i=0; i<boxes.length; i++){
                    cont++;
                    if(cont>=boxes.length){
                      cont = 0;
                    }

                    if(boxes.eq(cont).is(":visible")){
                     currentIndex = cont;  
                      break;
                    }
                }
            }

            var img = boxes.eq(currentIndex).children('img');

            //This is just when you want to link the lighbox to an url and refresh that url when you change the image on the Lighbox
            var url = boxes.eq(currentIndex).data('url');
            urlToLinkForLightbox = '';
            if(url != undefined && ops.linkOnLightbox == true){
                urlToLinkForLightbox = "http://"+url;
            }

            loadImage(img);
        };

        //Prev Post
        var prev = function(){
            closing = false;
            var boxes = $container.find('.gbox');

            currentIndex-=1;


            if(currentIndex < 0){
              currentIndex = boxes.length-1;
            }

            if(!boxes.eq(currentIndex).is(":visible")){//If prev is not visible then find the some one that is.
                var cont = currentIndex;
                for(var i=0; i<boxes.length; i++){
                    cont--;
                    if(cont<0){
                      cont = boxes.length-1;
                    }

                    if(boxes.eq(cont).is(":visible")){
                     currentIndex = cont;  
                      break;
                    }
                }
            }

            var img = boxes.eq(currentIndex).children('img');

            //This is just when you want to link the lighbox to an url and refresh that url when you change the image on the Lighbox
            var url = boxes.eq(currentIndex).data('url');
            urlToLinkForLightbox = '';
            if(url != undefined && ops.linkOnLightbox == true){
                urlToLinkForLightbox = "http://"+url;
            }

            loadImage(img);
        };


        //TRIGGER EVENTS
        $navNext.on('click', function(){  
            stopTimer();
            stopInterval();    
            next();
        });

        $lightbox.on('click', 'img', function(){
            if( urlToLinkForLightbox == '' ){
                stopTimer();
                stopInterval();
                next();  
            }else{
                location.href = urlToLinkForLightbox;
                //window.open(urlToLinkForLightbox , '_blank');
            }
            
        });

        $navPrev.on('click', function(){
            stopTimer();
            stopInterval();
            prev();
        });

        //Keyboard Navigation
        $(document).keyup(function(event){
            if(!ops.lightboxKeyboardNav)return;
            //prev keyCode
            if(event.keyCode == '37'){
                if(lightboxOpen == false)return;

                stopTimer();
                stopInterval();
                prev();
            }
            //next keyCode
            if(event.keyCode == '39'){
                if(lightboxOpen == false)return;

                stopTimer();
                stopInterval();
                next();
            }
            //esc keyCode
            if (event.keyCode == 27) { 
                close();
            }
        });

        if(ops.lightBoxAutoPlay){
            $navPlay.addClass('selected');
            playing = true;
        }

        //AUTO PLAY
        $navPlay.on('click', function(){

            $this = $(this);

            if($this.hasClass('selected')){
                $this.removeClass('selected');
                playing = false;
                stopTimer();
                stopInterval();
            }else{
                $this.addClass('selected');
                playing = true;
                play();
            }

            

        });

        //END LIGHTBOX //*********************************************************************//
    };
    //=End db





    if ( typeof options === 'string' ) {
      // call method
      var args = Array.prototype.slice.call( arguments, 1 );

      this.each(function(){
        var instance = $.data( this, 'grid' );
        if ( !instance ) {
          logError( "cannot call methods on grid prior to initialization; " +
            "attempted to call method '" + options + "'" );
          return;
        }
        if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
          logError( "no such method '" + options + "' for grid instance" );
          return;
        }
        // apply method
        instance[ options ].apply( instance, args );
      });
    } else {

      this.each(function() {
        var instance = $.data( this, 'grid' );

        if ( instance ) {
          // apply options & init
          instance.option( options || {} );
          instance._init();
        } else {
          
          //=db
          db(this);
          //=End db

          // initialize new instance
          $.data( this, 'grid', new $.Mason( options, this ) );
        }
      });
    }
    return this;
  };


  //Default settings
  $.fn.grid.defaults = {
      categoriesOrder: 'byName', //byDate, byDateReverse, byName, byNameReverse, random
      imagesOrder: 'byDate', //byDate, byDateReverse, byName, byNameReverse, random
      orderInAll: false, // When the 'All' tab is selected the images will be ordered as well and the 'aleatoryImagesFromCategories' option will not work
      isFitWidth: true, //Nedded to be true if you wish to center the gallery to its container
      lazyLoad: true, //If you wish to load more images when it reach the bottom of the page
      showNavBar: true, //Show the navigation bar?
      smartNavBar: true, //Hide the navigation bar when you don't have categories or just 1
      imagesToLoadStart: 15, //The number of images to load when it first loads the grid
      imagesToLoad: 5, //The number of images to load when you click the load more button
      aleatoryImagesFromCategories: true,//Get few images from each category if not it will get them in order
      horizontalSpaceBetweenThumbnails: 5, //The space between images horizontally
      verticalSpaceBetweenThumbnails: 5, //The space between images vertically
      columnWidth: 'auto', //The width of each columns, if you set it to 'auto' it will use the columns instead
      columns: 5, //The number of columns when you set columnWidth to 'auto'
      columnMinWidth: 220, //The minimum width of each columns when you set columnWidth to 'auto'
      isAnimated: true, //Animation when resizing or filtering with the nav bar
      caption: true, //Show the caption in mouse over
      captionCategory: true,//Show the category section of the caption
      captionType: 'grid', // 'grid', 'grid-fade', 'classic' the type of caption effect
      lightBox: true, //Do you want the lightbox?
      lightboxKeyboardNav: true, //Keyboard navigation of the next and prev image
      lightBoxSpeedFx: 500, //The speed of the lightbox effects
      lightBoxZoomAnim: true, //Do you want the zoom effect of the images in the lightbox?
      lightBoxText: true, //If you wish to show the text in the lightbox
      lightboxPlayBtn: true, //Show the play button?
      lightBoxAutoPlay: false, //The first time you open the lightbox it start playing the images
      lightBoxPlayInterval: 4000, //The interval in the auto play mode 
      lightBoxShowTimer: true, //If you wish to show the timer in auto play mode
      lightBoxStopPlayOnClose: false, //Stop the auto play mode when you close the lightbox?

      videos:  {}, 
      linkOnLightbox: false,

      hiddenStyle: { opacity: 0, scale: 0.001 },
      visibleStyle: { opacity: 1, scale: 1 },

      visibleCaption: false,
  };

})( window, jQuery );
