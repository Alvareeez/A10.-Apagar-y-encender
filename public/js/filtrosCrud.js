$(document).ready(function () {
    function fetchUsers() {
        $.ajax({
            url: "/usuarios/filter",
            method: 'GET',
            data: {
                search: $('#search').val(),
                seu: $('#seu').val(),
                role: $('#role').val()
            },
            success: function (response) {
                $('#usuarios-table').empty();
                response.forEach(function (usuario) {
                    $('#usuarios-table').append(`
                        <tr>
                            <td>${usuario.name}</td>
                            <td>${usuario.email}</td>
                            <td>${usuario.seu.seus}</td>
                            <td>${usuario.rol.roles}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="/usuarios/${usuario.id}/edit"><i class="fas fa-edit mx-3"></i></a>
                                    <form action="/usuarios/${usuario.id}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este usuario?')">
                                        <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    `);
                });
            }
        });
    }

    $('#search').on('keyup', fetchUsers);
    $('#seu').on('change', fetchUsers);
    $('#role').on('change', fetchUsers);
});