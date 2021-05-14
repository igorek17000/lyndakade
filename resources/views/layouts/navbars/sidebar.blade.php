<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="" class="simple-text logo-mini">{{ __('') }}</a>
            <a href="" class="simple-text logo-normal">{{ __('Dashboard') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('admin.home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="fab fa-laravel"></i>
                    <span class="nav-link-text">{{ __('Posts') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div
                    class="collapse{{ in_array($pageSlug, ['course', 'library', 'subject', 'software', 'learnpath', 'user']) ? " show": "" }}"
                    id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'course') class="active " @endif>
                            <a href="{{ route('admin.course.home')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('courses') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'library') class="active " @endif>
                            <a href="{{ route('admin.library.home')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('libraries') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'subject') class="active " @endif>
                            <a href="{{ route('admin.subject.home')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('subjects') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'software') class="active " @endif>
                            <a href="{{ route('admin.software.home')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('software') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'learnpath') class="active " @endif>
                            <a href="{{ route('admin.learnpath.home')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('learnpath') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'user') class="active " @endif>
                            <a href="{{ route('admin.user.home')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('User') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li @if ($pageSlug == 'icons') class="active " @endif>
                <a href="#">
                    <i class="tim-icons icon-atom"></i>
                    <p>{{ __('Icons') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'maps') class="active " @endif>
                <a href="#">
                    <i class="tim-icons icon-pin"></i>
                    <p>{{ __('Maps') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'notifications') class="active " @endif>
                <a href="#">
                    <i class="tim-icons icon-bell-55"></i>
                    <p>{{ __('Notifications') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'tables') class="active " @endif>
                <a href="#">
                    <i class="tim-icons icon-puzzle-10"></i>
                    <p>{{ __('Table List') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'typography') class="active " @endif>
                <a href="#">
                    <i class="tim-icons icon-align-center"></i>
                    <p>{{ __('Typography') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'rtl') class="active " @endif>
                <a href="#">
                    <i class="tim-icons icon-world"></i>
                    <p>{{ __('RTL Support') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
