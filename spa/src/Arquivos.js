import React, { Component } from 'react'
import 'materialize-css/dist/css/materialize.min.css'
import M from 'materialize-css'

class Arquivos extends Component {

    state = {
        arquivos: [
            {
                id: 1,
                nome: 'arquivo1.pdf' 
            }
        ]
    }

    enviaArquivos = (e) => {
        e.preventDefault()
        let arquivosRaw = document.getElementById("meu-input").files
        this.converteArrayArquivos(arquivosRaw).then(r => {
            fetch('http://gdoc-ms.test/salvaarquivos', {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                method: 'post',
                body: JSON.stringify({
                    arquivos: r
                })
            })
        })
    }

    converteUnit = f => new Promise(sucesso => {
        const reader = new FileReader()
        reader.readAsDataURL(f)
        reader.onload = () => sucesso(reader.result)
    })

    converteArrayArquivos = arquivos => new Promise(sucesso => {
        let arquivosArray = Array.from(arquivos)
        let arquivosConvertidos = []
        arquivosArray.map((a) => {
            this.converteUnit(a).then(r => {
                r = r.split('base64,')[1]
                let arqTemp = {
                    name: a.name,
                    type: a.type,
                    base64: r
                }
                console.log(arqTemp)
                arquivosConvertidos.push(arqTemp)
            })
        })
        setTimeout(() => {
            sucesso(arquivosConvertidos)
        }, 1000)
    })

    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col s6">
                        <form action="#">
                            <div className="file-field input-field">
                                <div className="btn">
                                    <span>File</span>
                                    <input id="meu-input" type="file" multiple />
                                </div>
                                <div className="file-path-wrapper">
                                    <input className="file-path validate" type="text" placeholder="Upload one or more files" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div className="col s1">
                        <a onClick={e => this.enviaArquivos(e)} className="waves-effect waves-teal btn-flat">Enviar</a>
                    </div>
                </div>
                <br/><br/><br/><br/><br/><br/>
                <div className="row">


                </div>
            </div>

        )
    }
}

export default Arquivos
