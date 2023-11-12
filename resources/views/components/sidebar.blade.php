<nav id="sidebar">
    <div class="p-4 pt-5">
    <h3><a  class="username">Admin</a></h3>
    <ul class="list-unstyled components mb-5">
        <li>
              <a href="{{route('project.list')}}">Projects</a>
        </li>
        <li>
              <a href="{{route('task.list')}}">Tasks</a>
        </li>
        <li>
             <a href="{{route('time.logs')}}">Time Log</a>
        </li>
        <li>
            <a href="{{route('report')}}">Report</a>
       </li>
    </ul>
    </div>
</nav>