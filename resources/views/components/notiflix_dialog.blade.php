@if (session()->has('success'))
<script>
   Notiflix.Notify.success("{{ session('success') }}"); 
</script>

@elseif(session()->has('info'))
<script>
   Notiflix.Notify.info("{{ session('info') }}"); 
</script>

@elseif(session()->has('error'))
<script>
   Notiflix.Notify.failure("{{ session('error') }}"); 
</script>

@endif