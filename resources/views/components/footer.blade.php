<footer class="footer has-background-dark is-primary">
    <div class="content has-text-centered has-text-white">
        <div class="columns">
            <div class="column">
                <p>GetThis</p>
                <p>2021</p>
            </div>
            <div class="column">
                <p>GBANGBOCHE Olabissi</p>
                <p><a href="mailto:olabissi.gbangboche@gmail.com">Mail</a></p>
                <p><a href="https://github.com/Ola-jed">Github</a></p>
            </div>
            <div class="column">
                <p>Github repository</p>
                <p><a href="https://github.com/Ola-jed/getThis" class="is-link is-white">https://github.com/Ola-jed/getThis</a></p>
                <form action="{{ url('/logout') }}" method="post">
                    @csrf
                    <button type="submit" class="button is-danger is-outlined">Logout</button>
                </form>
            </div>
        </div>
    </div>
</footer>
