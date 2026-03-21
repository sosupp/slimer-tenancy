<div>
   <div class="main-widgets-wrapper">
        @forelse ($this->widgetsData() as $data)
        <div>
            <div class="special-card-widget-wrapper">
                <div class="special-widget-card-item as-plain">
                    <div class="swidget-header-wrapper">
                        <div class="swidget-title">
                            {{-- <p class="icon-circular">
                                {!! $data['icon'] !!}
                            </p> --}}

                            <p class="widget-name">{{$data['label']}}</p>
                        </div>

                        <a wire:navigate href="{{$data['route']}}">
                            <div class="swidget-cta">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-external-link"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                                {{-- <p><small>DETAILS</small></p> --}}
                            </div>
                        </a>
                    </div>

                    <div class="widget-card-body">
                        <div class="special-widget-main-value">
                            <p class="swidget-main-value text-sharp">
                                {{$data['sums']['today'] ?? ''}}
                            </p>
                            <p class="swidget-label">
                                <small>Today</small>
                            </p>
                        </div>

                        <div class="special-widget-main-value">
                            <p class="swidget-value text-sharp">
                                {{$data['sums']['month'] ?? ''}}
                            </p>
                            <p class="swidget-label">
                                <small>month</small>
                            </p>
                        </div>

                        <div class="special-widget-main-value">
                            <p class="swidget-value">
                                {{$data['sums']['lifetime'] ?? ''}}
                            </p>
                            <p class="swidget-label">
                                <small>life time</small>
                            </p>
                        </div>
                    </div>

                    <div class="widget-card-footer">
                        <div class="other-widget-switch-item"></div>
                    </div>
                </div>
            </div>
        </div>
        @empty

        @endforelse
    </div>

</div>
