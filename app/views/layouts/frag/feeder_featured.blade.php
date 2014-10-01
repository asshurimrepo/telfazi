 <div class="row">
    <div class="col-md-12">
      <div id="carousel-example-generic" class="carousel slide feeder-carousel" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <?php $max = 4; ?>
          @if( $videos->count() > 0)
            @foreach( $videos as $i=>$v )
              @if($i%$max == 0)
                <div class="item feeder-entity {{ $i == 0 ? 'active' : '' }} ">
                  <div class="row">
              @endif 
              
                  <div class="col-md-3 col-xs-4 col-sm-2">
                    <div class="entity">
                      <div style="background: url({{ $v->getThumbnail() }}) no-repeat center;
                       background-size:cover;">
                        <a href="{{ URL::to('watch/'.$v->id) }}">
                          <img src="{{ asset('assets/img/whitespace.png') }}" class="hover playarrow-squ" width="100%">
                        </a>
                        <div class="hud text-right">
                          <span class=" empha">{{ $v->getDuration() }}</span>
                        </div>
                      </div>
                      
                      <div class="desc" title="{{ $v->title }}" style="cursor:pointer">
                        {{ $v->getTitle(50) }}
                      </div>
                    </div>   
                  </div>

              
              @if($i%$max == $max-1 || ($i+1 == $videos->count()))
                </div>
              </div>
              @endif 
                
            @endforeach
          @endif

        </div>


        @if( $videos->count() > $max )

          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
             <span class="left-control"> <img src="{{ asset('assets/img/carleft.png') }}"> </span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="right-control"> <img src="{{ asset('assets/img/carright.png') }}"> </span>
          </a>

        @endif
        

      </div>
    </div>
  </div>

