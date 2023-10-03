@if (session()->has('success'))
<script>
   Notiflix.Notify.success("{{ session('success') }}"); 
</script>
@endif