@if (session()->has('success'))
<script>
   Notiflix.Notify.success("{{ session('success') }}"); 
</script>

@elseif(session()->has('info'))
<script>
   Notiflix.Notify.info("{{ session('info') }}"); 
</script>

@endif