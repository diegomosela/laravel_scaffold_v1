<table width="100%" style="font-family: Arial, Tahoma, Verdana !important; background: #E2E2E2; padding: 30px 0; margin: 0;" border="0">
	<tr>
		<td align="center" border="0">

			<table width="100%" style="max-width: 600px; background: #FFF; padding: 15px;">
				<tr>
					<td align="center" style="font-size: 14px; padding: 15px;">

						<a href="{{ url('/') }}" target="_blank" style="color: #128c7e; font-size: 22px; font-weight: bold; text-decoration: none;">
							<img src="{{ url('assets/img/logotipo.png') }}" width="200"/>
						</a>

						<hr style="color: #f2f2f2; border: 1px solid #E2E2E2; margin: 30px 0;"/>

						@yield('content')

						<hr style="color: #f2f2f2; border: 1px solid #E2E2E2; margin: 30px 0;"/>

						<span style="display: inline-block; font-weight: bold; font-size: 12px; margin: 5px; color: #414141; margin-bottom: 5px;">
							<img src="{{ url('assets/img/logotipo.png') }}" width="75"/>
						</span>

						<br/>

						<span style="display: inline-block; font-weight: bold; font-size: 10px; margin: 0px; padding: 0">
							<a href="{{ url('/') }}" style="color: #666; text-decoration: none;">
								{{ 'página inicial' }}
							</a> |
							<a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}" style="color: #666; text-decoration: none;">
								{{ 'suporte' }}
							</a>
						</span>

						<br/>
						<br/>

						<span style="display: inline-block; color: #CCC; font-size: 10px;">
							{{ "mensagem enviada às " . date('Y/m/d - H:i') }}
						</span>

					</td>
				</tr>
			</table>

		</td>
	</tr>
</table>